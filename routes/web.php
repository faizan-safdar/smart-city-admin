<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Http\Controllers\DustbinController;
use App\Http\Controllers\CCTVController;
use App\Http\Controllers\EnergyController;
use App\Http\Controllers\StreetLightController;
use App\Http\Controllers\TrafficSignalController;
use App\Http\Controllers\WaterController;

// Main Page Route
Route::middleware('auth')->group(function () {
  // logout
  Route::get('/auth/logout', [LoginBasic::class, 'logout'])->name('logout');

  Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');
  Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
  Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
  Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
  Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
  Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

  // pages
  Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
  Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
  Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
  Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
  Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

  // cards
  Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

  // User Interface
  Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
  Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
  Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
  Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
  Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
  Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
  Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
  Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
  Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
  Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
  Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
  Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
  Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
  Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
  Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
  Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
  Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
  Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
  Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

  // extended ui
  Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
  Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

  // icons
  Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

  // form elements
  Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
  Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

  // form layouts
  Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
  Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

  // tables
  Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');
});
// layout

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::post('/auth/login-basic', [LoginBasic::class, 'indexPost'])->name('post.auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');


// dustbin routes
Route::get('/dustbins', [DustbinController::class, 'getAllBins']);
Route::get('/dustbin', [DustbinController::class, 'getAllBin']);
Route::get('/fetchDustbin/{id}', [DustbinController::class, 'fetchDustbin']);
Route::post('/dustbin/update', [DustbinController::class, 'storeOrUpdateDustbin'])->name('dustbin-update');

// dustbin details routes (Within Dustbin)
Route::get('/dustbin/{bin_id}', [DustbinController::class, 'getBinDetails'])->name('dustbin-details');

// dustbin usage routes (Within Dustbin)
Route::get('/fetchBinUsage/{id}', [DustbinController::class, 'fetchBinUsage']);
Route::post('/dustbin/bin-usage', [DustbinController::class, 'storeOrUpdateDustbinUsage'])->name('dustbin-usage-update');

// waste removal routes (Within Dustbin)
Route::get('/fetchWasteRemoval/{id}', [DustbinController::class, 'fetchWasteRemoval']);
Route::post('/dustbin/waste-removal', [DustbinController::class, 'storeOrUpdateDustbinWasteRemoval'])->name('dustbin-waste-removal');

// Repair Cost routes (Within Dustbin)
Route::get('/fetchRepairCost/{id}', [DustbinController::class, 'fetchRepairCost']);
Route::post('/dustbin/repair-cost', [DustbinController::class, 'storeOrUpdateDustbinRepairCost'])->name('repair-cost-update');

// Maintenance Cost routes (Within Dustbin))
Route::get('/fetchMaintenanceCost/{id}', [DustbinController::class, 'fetchMaintenanceCost']);
Route::post('/dustbin/maintenance-cost', [DustbinController::class, 'storeOrUpdateDustbinMaintenanceCost'])->name('maintenance-cost-update');

// Response time routes (Within Dustbin)
Route::get('/fetchResponseTime/{id}', [DustbinController::class, 'fetchResponseTime']);
Route::post('/dustbin/response-time', [DustbinController::class, 'storeOrUpdateDustbinResponseTime'])->name('response-time-update');

// Public Satisfaction routes (Within Dustbin))
Route::get('/fetchPublicSatisfaction/{id}', [DustbinController::class, 'fetchPublicSatisfaction']);
Route::post('/dustbin/public-satisfaction', [DustbinController::class, 'storeOrUpdateDustbinPublicSatisfaction'])->name('public-satisfaction-update');

// Waste Breakdown routes (Within Dustbin))
Route::get('/fetchWasteBreakdown/{id}', [DustbinController::class, 'fetchWasteBreakdown']);
Route::post('/dustbin/waste-breakdown', [DustbinController::class, 'storeOrUpdateDustbinWasteBreakdown'])->name('waste-breakdown-update');


//CCTVs routes
Route::get('/cctv', [CCTVController::class, 'getAllCctv']);
Route::get('/cctvs', [CCTVController::class, 'getAllCctvs'])->name('cctv');
Route::get('/fetchCCTV/{id}', [CCTVController::class, 'fetchCCTV']);
Route::post('/cctv/update', [CCTVController::class, 'storeOrUpdateCctv'])->name('cctv-update');

// TrafficSignals routes
Route::get('/traffic-signal', [TrafficSignalController::class, 'getSignalData']);
Route::get('/trafficsignals', [TrafficSignalController::class, 'getSignalsData'])->name('trafficsignals');
Route::get('/fetchTrafficsignals/{id}/{signal}', [TrafficSignalController::class, 'fetchTrafficSignal']);
Route::post('/trafficsignals/update', [TrafficSignalController::class, 'storeOrUpdateTrafficSignal'])->name('trafficsignals-update');

// Streetlights  routes
Route::get('/streetlight', [StreetLightController::class, 'getStreetLight']);
Route::get('/streetlights', [StreetLightController::class, 'getStreetLights'])->name('streetlights');
Route::get('/fetchStreetlight/{id}', [StreetLightController::class, 'fetchStreetLight']);
Route::post('/streetlight/update', [StreetLightController::class, 'storeOrUpdateStreetLight'])->name('streetlight-update');
Route::get('/streetlight/{id}', [StreetLightController::class, 'getStreetLightDetails'])->name('streetlight-details');

// Lamp Data(Current, Voltage, Photocell) routes (Within Streetlight)
Route::get('/fetchLampData/{id}/{lamp}', [StreetLightController::class, 'fetchLampData']);
Route::post('/streetlight/lamp-data-update', [StreetLightController::class, 'storeOrUpdateLampData'])->name('lamp-data-update');

// Lamp Graph Data(Current, Voltage, Photocell) routes (Within Streetlight)
Route::get('/fetchLampGraphData/{id}/{lamp}', [StreetLightController::class, 'fetchLampGraphData']);
Route::post('/streetlight/lamp-graph-data-update', [StreetLightController::class, 'storeOrUpdateLampGraphData'])->name('LampGraph-data-update');

// building routes
Route::get('/template',function(){
   return view('content.default-template.template');
});

// Energy routes
Route::get('/energy', [EnergyController::class, 'getEnergyData']);
Route::get('/energies', [EnergyController::class, 'getEnergiesData'])->name('energy');
Route::get('/fetchEnergy/{id}', [EnergyController::class, 'fetchEnergy']);
Route::post('/energy/update', [EnergyController::class, 'storeOrUpdateEnergy'])->name('energy-update');
Route::get('/energy/{id}', [EnergyController::class, 'getEnergyDetails'])->name('energy-details');

// Energy Data(Power, ACMV, ELECV, Lighting, Mixed Loads) routes (Within Energy)
Route::get('/fetchEnergyData/{id}/{energy}', [EnergyController::class, 'fetchEnergyData']);
Route::post('/energy/energy-data-update', [EnergyController::class, 'storeOrUpdateEnergyData'])->name('energy-data-update');

// Connection Types routes (Within Energy)
Route::get('/fetchConnectionType/{id}', [EnergyController::class, 'fetchConnectionTypes']);
Route::post('/energy/connection-types', [EnergyController::class, 'storeOrUpdateConnectionTypes'])->name('connection-types-update');

// Usage Hours Graph routes (Within Energy)
Route::get('/fetchUsageHours/{id}', [EnergyController::class, 'fetchUsageHoursGraph']);
Route::post('/energy/usage-hours-graph', [EnergyController::class, 'storeOrUpdateUsageHours'])->name('usage-hours-graph-update');

// Water Usage routes
Route::get('/water-usage', [WaterController::class, 'getWaterUsage']);
Route::get('/water-usages', [WaterController::class, 'getWaterUsages'])->name('water-usage');
Route::get('/fetchWaterUsage/{id}', [WaterController::class, 'fetchWaterUsage']);
Route::post('/water-usage/update', [WaterController::class, 'storeOrUpdateWaterUsage'])->name('water-usage-update');
Route::get('/water-usage/{id}', [WaterController::class, 'fetchWaterUsageDetails'])->name('water-usage-details');

// Energy Utilization routes (Within Water Usage)
Route::get('/fetchWaterEnergyUtilization/{id}', [WaterController::class, 'fetchWaterEnergyUtilization']);
Route::post('/water-usage/energy-utilization', [WaterController::class, 'storeOrUpdateEnergyUtilization'])->name('energy-utilization-update');

// Electricity Consumption routes (Within Water Usage)
Route::get('/water-usage/electricity-consumption/{month}/{water_id}', [WaterController::class, 'MonthlyWaterElectricityConsumption'])->name('monthly-electricity-consumption');
Route::get('/fetchElectricityConsumption/{id}', [WaterController::class, 'fetchElectricityConsumption']);
Route::post('/water-usage/electricity-consumption', [WaterController::class, 'waterElectricityConsumption'])->name('electricity-consumption-update');

// Energy Breakdown routes (Within Water Usage)
Route::get('/fetchWaterEnergyBreakdown/{id}', [WaterController::class, 'fetchWaterEnergyBreakdown']);
Route::post('/water-usage/energy-breakdown', [WaterController::class, 'waterEnergyBreakdown'])->name('energy-breakdown-update');

// Usage Breakdown and Waste Discharges routes (Within Water Usage)
Route::get('/fetchUsageBreakdownWasteDischarges/{id}/{type}', [WaterController::class, 'fetchUsageBreakdownWasteDischarges']);
Route::post('/water-usage/usage-breakdown-waste-discharges', [WaterController::class, 'storeOrUpdateUsageBreakdownWasteDischarges'])->name('usage-breakdown-waste-discharges-update');

// Average Consumption routes (Within Water Usage)
Route::get('/water-usage/Average-consumption/{month}/{water_id}', [WaterController::class, 'MonthlyWaterAverageConsumption'])->name('monthly-average-consumption');
Route::get('/fetchAverageConsumption/{id}', [WaterController::class, 'fetchAverageConsumption']);
Route::post('/water-usage/average-consumption', [WaterController::class, 'waterAverageConsumption'])->name('average-consumption-update');
