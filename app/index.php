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
require_once '../public/components/common/calendar.php';

//components for admin and superadmin to approve studentrepps and clubreps
require_once '../public/components/common/approveByAdmin/approvecards.php';
require_once '../public/components/common/approveByAdmin/approveArea.php';

//components for feeds
require_once '../public/components/common/feeds/feedPost.php';
require_once '../public/components/common/feeds/feedArea.php';

// Components for elections
require_once '../public/components/common/elections/electionCard/electionCard.php';
require_once '../public/components/common/elections/electionCard/prevElectionCard.php';
require_once '../public/components/common/elections/candidateCard.php';

// Charts for admin panel and Super admin panel
require_once '../public/components/common/charts/adminPanelChartOne.php';
require_once '../public/components/common/charts/adminPanelChartTwo.php';
require_once '../public/components/common/charts/adminPanelChartThree.php';
require_once '../public/components/common/charts/adminPanelChartFour.php';
require_once '../public/components/common/charts/adminPanelChartFive.php';

// Components for Counselor
// require_once '../public/components/common/counselor/counselorSidebar.php';

//components for user details card
require_once '../public/components/common/userDetails/userDetailsArea.php';
require_once '../public/components/common/userDetails/userDetailsCards.php';

//components for log details card
require_once '../public/components/common/logDetails/logDetailsArea.php';
require_once '../public/components/common/logDetails/logDetailsCards.php';
