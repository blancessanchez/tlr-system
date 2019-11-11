<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php foreach($leaveApplications as $leave) : ?>
<div class="container" style="page-break-after: always;">
  <div class="row">
    <div class="col-sm">CS Form No. 6</div>
  </div>
  <div class="row">
    <div class="col-sm">Revised 1984</div>
  </div>
  <div class="row">
    <div class="col-sm-12 text-center">APPLICATION FOR LEAVE</div>
  </div>
  </br>
  <div class="row border-top border-left border-right">
    <div class="col-sm">1. OFFICE/ AGENCY</div>
    <div class="col-sm">2. NAME(LAST)</div>
    <div class="col-sm">(FIRST)</div>
    <div class="col-sm">(MIDDLE)</div>
  </div>
  <div class="row border-bottom border-left border-right">
    <div class="col-sm">BULIHAN N.H.S.</div>
    <div class="col-sm"><?= $leave->employee_information->last_name ?></div>
    <div class="col-sm"><?= $leave->employee_information->first_name ?></div>
    <div class="col-sm"><?= $leave->employee_information->middle_name ?></div>
  </div>
  <div class="row">
    <div class="col-sm-3">3. DATE OF FILING </div>
    <div class="col-sm-3">4. POSITION </div>
    <div class="col-sm-6">5. SALARY (MONTHLY)</div>
  </div>
  <div class="row">
    <div class="col-sm-3"><?= $leave->created->i18nFormat('YYYY-MM-dd') ?></div>
    <div class="col-sm-3"><?= $leave->employee_information->job_position->title ?></div>
    <div class="col-sm-6"><?= $leave->employee_information->salary ?></div>
  </div>
  <div class="row border border-dark">
    <div class="col-sm-4">6.</div>
    <div class="col-sm-8">DETAILS OF APPLICATION</div>
  </div>
  </br>
  <div class="row">
    <div class="col-sm">6. a) TYPE OF LEAVE</div>
    <div class="col-sm">6. b) WHERE LEAVE WILL BE SPENT</div>
  </div>
  <div class="row">
    <div class="col-sm"></div>
    <div class="col-sm border box"><?= $leave->leave_type_id == 1 ? '/' : '' ?></div>
    <div class="col-sm-4">VACATION</div>
    <div class="col-sm-6">(1) IN CASE OF VACATION LEAVE</div>
  </div>
  <div class="row">
    <div class="col-sm"></div>
    <div class="col-sm border box"><?= $leave->leave_type_id == 3 ? '/' : '' ?></div>
    <div class="col-sm-4">TO SEEK EMPLOYMENT</div>
    <div class="col-sm border box"><?= $leave->leave_category_id == 1 ? '/' : '' ?></div>
    <div class="col-sm-5">WITH IN THE PHILIPPINES</div>
  </div>
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-2">OTHERS(specify)</div>
    <div class="col-sm-2 border-bottom"><?= $leave->leave_description ?></div>
    <div class="col-sm border box"><?= $leave->leave_category_id == 2 ? '/' : '' ?></div>
    <div class="col-sm-2">ABROAD (SPECIFY)</div>
    <div class="col-sm-3 border-bottom"><?= $leave->leave_description ?></div>
  </div>
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-4 border-bottom">.</div>
    <div class="col-sm-2"></div>
    <div class="col-sm-4 border-bottom">.</div>
  </div>
  <div class="row">
    <div class="col-sm"><?= $leave->leave_type_id == 2 ? '/' : '' ?></div>
    <div class="col-sm border box"></div>
    <div class="col-sm-10">SICK</div>
  </div>
  <div class="row">
    <div class="col-sm"></div>
    <div class="col-sm border box"><?= $leave->leave_type_id == 4 ? '/' : '' ?></div>
    <div class="col-sm-4">MATERNITY</div>
    <div class="col-sm-6">(2) IN CASE OF SICK LEAVE</div>
  </div>
  <div class="row">
    <div class="col-sm"></div>
    <div class="col-sm border box"><?= $leave->leave_type_id == 5 ? '/' : '' ?></div>
    <div class="col-sm-4">OTHERS(specify)</div>
    <div class="col-sm border box"><?= $leave->leave_category_id == 3 ? '/' : '' ?></div>
    <div class="col-sm-5">IN HOSPITAL(specify)</div>
  </div>
  </br>
  <div class="row">
    <div class="col-sm-6"></div>
    <div class="col-sm border box"><?= $leave->leave_category_id == 4 ? '/' : '' ?></div>
    <div class="col-sm-3">OUTPATIENT (Specify)</div>
    <div class="col-sm-2 border-bottom"><?= $leave->leave_description ?></div>
  </div>
  <div class="row">
    <div class="col-sm-7"></div>
    <div class="col-sm-5 border-bottom">.</div>
  </div>
  </br>
  <div class="row">
    <div class="col-sm">6. c) NUMBER OF WORKING DAYS</div>
    <div class="col-sm">6. d) COMMUTATION</div>
  </div>
  <div class="row">
    <div class="col-sm"></div>
    <div class="col-sm-2">APPLIED FOR</div>
    <div class="col-sm-3 border-bottom"><?= $leave->applied_for ?></div>
    <div class="col-sm-6"></div>
  </div>
  <div class="row">
    <div class="col-sm"></div>
    <div class="col-sm-2">INCLUSIVE DATES</div>
    <div class="col-sm-3 border-bottom"><?= $leave->applied_from . '-' . $leave->applied_to ?></div>
    <div class="col-sm border box"><?= $leave->commutation == 1 ? '/' : '' ?></div>
    <div class="col-sm-2">requested</div>
    <div class="col-sm border box"><?= $leave->commutation == 2 ? '/' : '' ?></div>
    <div class="col-sm-2">not requested</div>
  </div>
  </br>
  </br>
  </br>
  <div class="row">
    <div class="col-sm-7"></div>
    <div class="col-sm">(Signature of Applicant)</div>
  </div>
  </br>
  <div class="row border border-dark">
    <div class="col-sm-4">7.</div>
    <div class="col-sm-8">DETAILS ON ACTION OF APPLICATION</div>
  </div>
  </br>
  <div class="row">
    <div class="col-sm">7. a) CERTIFICATION OF LEAVE CREDITS</div>
    <div class="col-sm">7. b) RECOMMENDATION</div>
  </div>
  <div class="row">
    <div class="col-sm"></div>
    <div class="col-sm">AS OF</div>
    <div class="col-sm-4 border-bottom">.</div>
    <div class="col-sm border box"><?= $leave->leave_status == 2 ? '/' : '' ?></div>
    <div class="col-sm-2">APPROVAL</div>
    <div class="col-sm-3"></div>
  </div>
  <div class="row">
    <div class="col-sm-6"></div>
    <div class="col-sm border box"><?= $leave->leave_status == 4 ? '/' : '' ?></div>
    <div class="col-sm-2">DISAPPROVAL DUE TO</div>
    <div class="col-sm-3"></div>
  </div>
  <div class="row">
    <div class="col-sm"></div>
    <div class="col-sm border-top border-left border-right border-thick text-center">VACATION</div>
    <div class="col-sm border-top border-left border-right border-thick text-center">SICK</div>
    <div class="col-sm border-top border-left border-right border-thick text-center">TOTAL</div>
    <div class="col-sm"></div>
    <div class="col-sm-5 border-bottom"><?= $leave->leave_application_response->recommendation_description ?></div>
  </div>
  <div class="row">
    <div class="col-sm">.</div>
    <div class="col-sm border-left border-right border-thick"></div>
    <div class="col-sm border-left border-right border-thick"></div>
    <div class="col-sm border-left border-right border-thick"></div>
    <div class="col-sm"></div>
    <div class="col-sm-5 border-bottom"></div>
  </div>
  <div class="row">
    <div class="col-sm"></div>
    <div class="col-sm border-bottom border-left border-right border-thick text-center">DAYS</div>
    <div class="col-sm border-bottom border-left border-right border-thick text-center">DAYS</div>
    <div class="col-sm border-bottom border-left border-right border-thick text-center">DAYS</div>
    <div class="col-sm"></div>
    <div class="col-sm-5"></div>
  </div>
  </br>
  </br>
  </br>
  </br>
  <div class="row">
    <div class="col-sm text-center">VERNA C. CABAYA</div>
    <div class="col-sm text-center">CRISTINA M. AUSTRIA</div>
  </div>
  <div class="row">
    <div class="col-sm text-center">ADMINISTRATIVE OFFICER V</div>
    <div class="col-sm text-center">PRINCIPAL IV</div>
  </div>
  </br>
  </br>
  </br>
  <div class="row">
    <div class="col-sm">7. c) APPROVED FOR:</div>
    <div class="col-sm">7. d) DISAPPROVED DUE TO:</div>
  </div>
  <div class="row">
    <div class="col-sm border-bottom"></div>
    <div class="col-sm-5">DAYS WITH PAY</div>
    <div class="col-sm-6 border-bottom"></div>
  </div>
  <div class="row">
    <div class="col-sm border-bottom"></div>
    <div class="col-sm-5">DAYS WITHOUT PAY</div>
    <div class="col-sm-6 border-bottom"></div>
  </div>
  <div class="row">
    <div class="col-sm border-bottom"></div>
    <div class="col-sm-5">OTHER (Specify)</div>
    <div class="col-sm-6 border-bottom"></div>
  </div>
  </br>
  </br>
  <div class="row">
    <div class="col-sm-12 text-center">ELIAS A. ALICAYA JR, Ed.D.</div>
  </div>
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4 border-bottom text-center">Assistant Schools Division Superintendent</div>
    <div class="col-sm-4"></div>
  </div>
  <div class="row">
    <div class="col-sm-12 text-center">(Signature)</div>
  </div>
  </br>
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4 border-bottom text-center">.</div>
    <div class="col-sm-4"></div>
  </div>
  </br>
  <div class="row">
    <div class="col-sm">DATE: <?= date('Y-m-d') ?></div>
  </div>
</div>
<?php endforeach; ?>
<style type="text/css">
  .box {
    border: 2px solid black !important;
    text-align: center !important;
  }

  .border-left {
    border-left: solid 1px black !important;
  }

  .border-right {
    border-right: solid 1px black !important;
  }

  .border-top {
    border-top: solid 1px black !important;
  }

  .border-bottom {
    border-bottom: solid 1px black !important;
  }

  .border-thick {
    border-width: 2px !important;
  }
</style>