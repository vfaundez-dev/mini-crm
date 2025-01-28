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
    return ($estimatedValue > 0 && $successProbability >= 0 && $successProbability <= 100)
      ? $estimatedValue * ($successProbability / 100)
      : 0;
  }

  /* PROCCESS OPPORTUNITY */

  public function prepareOpportunity($validatedData) {
    // OPP Validations
    $this->validateCloseOpp( $validatedData['status'] );
    $this->validateActualCloseDate( $validatedData['status'], $validatedData['actual_close_date'] );
    $this->validateSuccessProbability( $validatedData['stage_id'], $validatedData['success_probability'] );
    // OPP Calculations
    $validatedData['weighted_value'] = $this->calculateWeightedValue(
      $validatedData['estimated_value'] ?? 0,
      $validatedData['success_probability']
    );

    return $validatedData;
  }

  public function prepareCloseOpportunity($opportunity, $closedStatus) {
    $this->validateCloseOpp($opportunity->status);

    // Update status, success probability and closing date
    $opportunity->status = $closedStatus;
    $opportunity->success_probability = 
        intval($closedStatus) == $this->opportunityRepository::STATUS_CLOSED_WON ? 100 : 0;
    $opportunity->actual_close_date = now();

    // Recalculate the weighted value if necessary
    if ($opportunity->status === $this->opportunityRepository::STATUS_CLOSED_WON) {
        $opportunity->weighted_value = $this->calculateWeightedValue($opportunity->estimated_value, 100);
    } else {
        $opportunity->weighted_value = 0;
    }

    return $opportunity;
  }

}