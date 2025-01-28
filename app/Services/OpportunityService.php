<?php

namespace App\Services;

use \Illuminate\Validation\ValidationException;

class OpportunityService {

  /*-- VALIDATIONS --*/

  public function validateCloseOpp($status) {
    if ( intval($status) !== \App\Repositories\OpportunityRepository::STATUS_OPEN ) {
      throw ValidationException::withMessages([
        'status' => 'Only open opportunities can be closed.',
      ]);
    }
  }

  public function validateActualCloseDate($status, $actualCloseDate) {
    if (intval($status) === 2 || intval($status) === 1) {
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

}