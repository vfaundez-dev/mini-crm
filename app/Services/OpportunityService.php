<?php

namespace App\Services;

use App\Repositories\OpportunityRepository;
use \Illuminate\Validation\ValidationException;
class OpportunityService {

  protected $opportunityRepository;

  public function __construct(OpportunityRepository $opportunityRepository) {
    $this->opportunityRepository = $opportunityRepository;
  }

  /*-- VALIDATIONS --*/

  public function validateCloseOpp($status) {
    if (intval($status) !== $this->opportunityRepository::STATUS_OPEN) {
      throw ValidationException::withMessages([
        'status' => 'Only open opportunities can be closed.',
      ]);
    }
  }

  public function validateActualCloseDate($status, $actualCloseDate) {
    if (intval($status) === $this->opportunityRepository::STATUS_CLOSED_WON || intval($status) === $this->opportunityRepository::STATUS_CLOSED_LOST) {
      if (!$actualCloseDate) {
        throw ValidationException::withMessages([
          'actual_close_date' => 'Actual closing date is required if the opportunity is closed.',
        ]);
      }
    }
  }

  public function validateSuccessProbability($stageId, $successProbability) {
    if ($stageId == 1 && $successProbability > 50) {
      throw ValidationException::withMessages([
        'success_probability' => 'The success probability should be low in the prospecting stage.',
      ]);
    }
  }

  /* CALCULATIONS */

  public function calculateSuccessProbability($stageId) {
    $stageModel = \App\Models\OpportunityStage::find($stageId);
    return $stageModel ? $stageModel->probability : 0;
  }

  public function calculateWeightedValue($estimatedValue, $successProbability) {
    return ( $estimatedValue > 0 && $successProbability >= 0 && $successProbability <= 100 )
      ? $estimatedValue * ($successProbability / 100)
      : 0;
  }

  /* PROCCESS OPPORTUNITY */

  public function prepareOpportunity($validatedData, $opportunity = null) {

    // 1. If it is a new opportunity, validate that it only has the status "Open"
    if (!$opportunity) {
      $this->validateCloseOpp( $validatedData['status'] );
    }

    // 2. If an opportunity has a status other than "Open", we update the "Stage" value
    if ( intval($validatedData['status']) !== $this->opportunityRepository::STATUS_OPEN ) {
      $validatedData['stage_id'] = match ( intval($validatedData['status']) ) {
        $this->opportunityRepository::STATUS_CLOSED_WON => 6,
        $this->opportunityRepository::STATUS_CLOSED_LOST => 7,
        default => $validatedData['stage_id'],
      };
    }

    // 3. Calculate the success probability value
    $validatedData['success_probability'] = $this->calculateSuccessProbability( $validatedData['stage_id'] );

    // 4. Validate "Actual Close Date" and "Success Probability"
    $this->validateActualCloseDate( $validatedData['status'], $validatedData['actual_close_date'] );
    $this->validateSuccessProbability( $validatedData['stage_id'], $validatedData['success_probability'] );

    // 5. Calculate "Weighted Value"
    $validatedData['weighted_value'] = $this->calculateWeightedValue(
      $validatedData['estimated_value'],
      $validatedData['success_probability']
    );

    return $validatedData;
    
  }

  public function prepareCloseOpportunity($opportunity, $closedStatus) {

    // 1. Validate only the closing of open opportunities
    $this->validateCloseOpp($opportunity->status);

    // 2. Update status, stage, success probability and closing date
    $opportunity->status = $closedStatus;
    $opportunity->stage_id = match ( intval($closedStatus) ) {
      $this->opportunityRepository::STATUS_CLOSED_WON => 6,
      $this->opportunityRepository::STATUS_CLOSED_LOST => 7,
      default => $opportunity->stage_id,
    };
    $opportunity->success_probability = intval($closedStatus) == $this->opportunityRepository::STATUS_CLOSED_WON ? 100 : 0;
    $opportunity->actual_close_date = now();

    // 3. Recalculate weighted value if necessary
    if ( intval($closedStatus) !== $this->opportunityRepository::STATUS_OPEN ) {
      $opportunity->weighted_value = match ( intval($closedStatus) ) {
        $this->opportunityRepository::STATUS_CLOSED_WON => $this->calculateWeightedValue($opportunity->estimated_value, 100),
        $this->opportunityRepository::STATUS_CLOSED_LOST => 0,
        default => $opportunity->weighted_value,
      };
    }

    return $opportunity;
  }

}