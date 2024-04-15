<?php
// error_reporting(E_ERROR | E_PARSE);

require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';
require_once '../app/core/Model.php';

require_once '../public/components/common/HTMLHead.php';
require_once '../public/components/common/HTMLFooter.php';
require_once '../public/components/common/header.php';
require_once '../public/components/common/sidebar.php';
require_once '../public/components/common/welcomeSearch.php';

require_once '../public/components/common/calendar.php';

//components for admin and superadmin to approve studentrepps and clubreps
require_once '../public/components/common/approveByAdmin/approveArea.php';

// Components for elections
require_once '../public/components/common/elections/candidateCard.php';

// Charts for admin panel and Super admin panel
require_once '../public/components/common/charts/adminPanelChartOne.php';
require_once '../public/components/common/charts/adminPanelChartTwo.php';
require_once '../public/components/common/charts/adminPanelChartThree.php';
require_once '../public/components/common/charts/adminPanelChartFour.php';
require_once '../public/components/common/charts/adminPanelChartFive.php';

//charts for live results
require_once '../public/components/common/charts/liveResultsOne.php';
require_once '../public/components/common/charts/liveResultsTwo.php';

// Components for Counselor
require_once '../public/components/common/counselorReservations/reservationTable.php';
require_once '../public/components/common/counselorReservations/reservationCards.php';

//components for log details card
require_once '../public/components/common/logDetails/logDetailsArea.php';
require_once '../public/components/common/logDetails/logDetailsCards.php';

//components for studentrep to approve teaching students
require_once '../public/components/common/approveByStudentRep/approveTeachingStudentsArea.php';
require_once '../public/components/common/approveByStudentRep/approveTeachingStudentsCards.php';
