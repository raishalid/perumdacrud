<?php

namespace PHPMaker2023\crudperumdautama;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ProjectsEdit extends Projects
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "ProjectsEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "ProjectsEdit";

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Set field visibility
    public function setVisibility()
    {
        $this->id->setVisibility();
        $this->project_category_id->setVisibility();
        $this->project_provider_id->setVisibility();
        $this->project_status_id->setVisibility();
        $this->funding_source_id->setVisibility();
        $this->project_name->setVisibility();
        $this->project_description->setVisibility();
        $this->project_budget->setVisibility();
        $this->project_target->setVisibility();
        $this->project_start->setVisibility();
        $this->project_duration->setVisibility();
        $this->project_html->setVisibility();
        $this->project_headgbr->setVisibility();
        $this->slug->setVisibility();
        $this->created_at->setVisibility();
        $this->updated_at->setVisibility();
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer;
        $this->TableVar = 'projects';
        $this->TableName = 'projects';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (projects)
        if (!isset($GLOBALS["projects"]) || get_class($GLOBALS["projects"]) == PROJECT_NAMESPACE . "projects") {
            $GLOBALS["projects"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'projects');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();
    }

    // Get content from stream
    public function getContents(): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

        // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response (Assume return to modal for simplicity)
            if ($this->IsModal) { // Show as modal
                $result = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page => View page
                    $result["caption"] = $this->getModalCaption($pageName);
                    $result["view"] = $pageName == "ProjectsView"; // If View page, no primary button
                } else { // List page
                    // $result["list"] = $this->PageID == "search"; // Refresh List page if current page is Search page
                    $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                    $this->clearFailureMessage();
                }
                WriteJson($result);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;
        $name = $ar["name"] ?? Post("name");
        $isQuery = ContainsString($name, "query_builder_rule");
        if ($isQuery) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }

    // Properties
    public $FormClassName = "ew-form ew-edit-form overlay-wrapper";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;
    public $DetailPages; // Detail pages object

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $UserProfile, $Language, $Security, $CurrentForm, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->setVisibility();
        $this->slug->Required = false;

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Set up detail page object
        $this->setupDetailPages();

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Hide fields for add/edit
        if (!$this->UseAjaxActions) {
            $this->hideFieldsForAddEdit();
        }
        // Use inline delete
        if ($this->UseAjaxActions) {
            $this->InlineDelete = true;
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->project_category_id);
        $this->setupLookupOptions($this->project_provider_id);
        $this->setupLookupOptions($this->project_status_id);
        $this->setupLookupOptions($this->funding_source_id);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("id") ?? Key(0) ?? Route(2)) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->id->setOldValue($this->id->QueryStringValue);
            } elseif (Post("id") !== null) {
                $this->id->setFormValue(Post("id"));
                $this->id->setOldValue($this->id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action", "") !== "") {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("id") ?? Route("id")) !== null) {
                    $this->id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values

            // Set up detail parameters
            $this->setupDetailParms();
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("ProjectsList"); // No matching record, return to list
                        return;
                    }

                // Set up detail parameters
                $this->setupDetailParms();
                break;
            case "update": // Update
                if ($this->getCurrentDetailTable() != "") { // Master/detail edit
                    $returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
                } else {
                    $returnUrl = $this->getReturnUrl();
                }
                if (GetPageName($returnUrl) == "ProjectsList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) {
                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "ProjectsList") {
                            Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "ProjectsList"; // Return list page content
                        }
                    }
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsJsonResponse()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->IsModal && $this->UseAjaxActions) { // Return JSON error message
                    WriteJson([ "success" => false, "validation" => $this->getValidationErrors(), "error" => $this->getFailureMessage() ]);
                    $this->clearFailureMessage();
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed

                    // Set up detail parameters
                    $this->setupDetailParms();
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey) {
            $this->id->setFormValue($val);
        }

        // Check field name 'project_category_id' first before field var 'x_project_category_id'
        $val = $CurrentForm->hasValue("project_category_id") ? $CurrentForm->getValue("project_category_id") : $CurrentForm->getValue("x_project_category_id");
        if (!$this->project_category_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->project_category_id->Visible = false; // Disable update for API request
            } else {
                $this->project_category_id->setFormValue($val);
            }
        }

        // Check field name 'project_provider_id' first before field var 'x_project_provider_id'
        $val = $CurrentForm->hasValue("project_provider_id") ? $CurrentForm->getValue("project_provider_id") : $CurrentForm->getValue("x_project_provider_id");
        if (!$this->project_provider_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->project_provider_id->Visible = false; // Disable update for API request
            } else {
                $this->project_provider_id->setFormValue($val);
            }
        }

        // Check field name 'project_status_id' first before field var 'x_project_status_id'
        $val = $CurrentForm->hasValue("project_status_id") ? $CurrentForm->getValue("project_status_id") : $CurrentForm->getValue("x_project_status_id");
        if (!$this->project_status_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->project_status_id->Visible = false; // Disable update for API request
            } else {
                $this->project_status_id->setFormValue($val);
            }
        }

        // Check field name 'funding_source_id' first before field var 'x_funding_source_id'
        $val = $CurrentForm->hasValue("funding_source_id") ? $CurrentForm->getValue("funding_source_id") : $CurrentForm->getValue("x_funding_source_id");
        if (!$this->funding_source_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->funding_source_id->Visible = false; // Disable update for API request
            } else {
                $this->funding_source_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'project_name' first before field var 'x_project_name'
        $val = $CurrentForm->hasValue("project_name") ? $CurrentForm->getValue("project_name") : $CurrentForm->getValue("x_project_name");
        if (!$this->project_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->project_name->Visible = false; // Disable update for API request
            } else {
                $this->project_name->setFormValue($val);
            }
        }

        // Check field name 'project_description' first before field var 'x_project_description'
        $val = $CurrentForm->hasValue("project_description") ? $CurrentForm->getValue("project_description") : $CurrentForm->getValue("x_project_description");
        if (!$this->project_description->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->project_description->Visible = false; // Disable update for API request
            } else {
                $this->project_description->setFormValue($val);
            }
        }

        // Check field name 'project_budget' first before field var 'x_project_budget'
        $val = $CurrentForm->hasValue("project_budget") ? $CurrentForm->getValue("project_budget") : $CurrentForm->getValue("x_project_budget");
        if (!$this->project_budget->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->project_budget->Visible = false; // Disable update for API request
            } else {
                $this->project_budget->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'project_target' first before field var 'x_project_target'
        $val = $CurrentForm->hasValue("project_target") ? $CurrentForm->getValue("project_target") : $CurrentForm->getValue("x_project_target");
        if (!$this->project_target->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->project_target->Visible = false; // Disable update for API request
            } else {
                $this->project_target->setFormValue($val);
            }
        }

        // Check field name 'project_start' first before field var 'x_project_start'
        $val = $CurrentForm->hasValue("project_start") ? $CurrentForm->getValue("project_start") : $CurrentForm->getValue("x_project_start");
        if (!$this->project_start->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->project_start->Visible = false; // Disable update for API request
            } else {
                $this->project_start->setFormValue($val, true, $validate);
            }
            $this->project_start->CurrentValue = UnFormatDateTime($this->project_start->CurrentValue, $this->project_start->formatPattern());
        }

        // Check field name 'project_duration' first before field var 'x_project_duration'
        $val = $CurrentForm->hasValue("project_duration") ? $CurrentForm->getValue("project_duration") : $CurrentForm->getValue("x_project_duration");
        if (!$this->project_duration->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->project_duration->Visible = false; // Disable update for API request
            } else {
                $this->project_duration->setFormValue($val);
            }
        }

        // Check field name 'project_html' first before field var 'x_project_html'
        $val = $CurrentForm->hasValue("project_html") ? $CurrentForm->getValue("project_html") : $CurrentForm->getValue("x_project_html");
        if (!$this->project_html->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->project_html->Visible = false; // Disable update for API request
            } else {
                $this->project_html->setFormValue($val);
            }
        }

        // Check field name 'project_headgbr' first before field var 'x_project_headgbr'
        $val = $CurrentForm->hasValue("project_headgbr") ? $CurrentForm->getValue("project_headgbr") : $CurrentForm->getValue("x_project_headgbr");
        if (!$this->project_headgbr->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->project_headgbr->Visible = false; // Disable update for API request
            } else {
                $this->project_headgbr->setFormValue($val);
            }
        }

        // Check field name 'slug' first before field var 'x_slug'
        $val = $CurrentForm->hasValue("slug") ? $CurrentForm->getValue("slug") : $CurrentForm->getValue("x_slug");
        if (!$this->slug->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->slug->Visible = false; // Disable update for API request
            } else {
                $this->slug->setFormValue($val);
            }
        }

        // Check field name 'created_at' first before field var 'x_created_at'
        $val = $CurrentForm->hasValue("created_at") ? $CurrentForm->getValue("created_at") : $CurrentForm->getValue("x_created_at");
        if (!$this->created_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->created_at->Visible = false; // Disable update for API request
            } else {
                $this->created_at->setFormValue($val, true, $validate);
            }
            $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        }

        // Check field name 'updated_at' first before field var 'x_updated_at'
        $val = $CurrentForm->hasValue("updated_at") ? $CurrentForm->getValue("updated_at") : $CurrentForm->getValue("x_updated_at");
        if (!$this->updated_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->updated_at->Visible = false; // Disable update for API request
            } else {
                $this->updated_at->setFormValue($val, true, $validate);
            }
            $this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->project_category_id->CurrentValue = $this->project_category_id->FormValue;
        $this->project_provider_id->CurrentValue = $this->project_provider_id->FormValue;
        $this->project_status_id->CurrentValue = $this->project_status_id->FormValue;
        $this->funding_source_id->CurrentValue = $this->funding_source_id->FormValue;
        $this->project_name->CurrentValue = $this->project_name->FormValue;
        $this->project_description->CurrentValue = $this->project_description->FormValue;
        $this->project_budget->CurrentValue = $this->project_budget->FormValue;
        $this->project_target->CurrentValue = $this->project_target->FormValue;
        $this->project_start->CurrentValue = $this->project_start->FormValue;
        $this->project_start->CurrentValue = UnFormatDateTime($this->project_start->CurrentValue, $this->project_start->formatPattern());
        $this->project_duration->CurrentValue = $this->project_duration->FormValue;
        $this->project_html->CurrentValue = $this->project_html->FormValue;
        $this->project_headgbr->CurrentValue = $this->project_headgbr->FormValue;
        $this->slug->CurrentValue = $this->slug->FormValue;
        $this->created_at->CurrentValue = $this->created_at->FormValue;
        $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        $this->updated_at->CurrentValue = $this->updated_at->FormValue;
        $this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->id->setDbValue($row['id']);
        $this->project_category_id->setDbValue($row['project_category_id']);
        $this->project_provider_id->setDbValue($row['project_provider_id']);
        $this->project_status_id->setDbValue($row['project_status_id']);
        $this->funding_source_id->setDbValue($row['funding_source_id']);
        $this->project_name->setDbValue($row['project_name']);
        $this->project_description->setDbValue($row['project_description']);
        $this->project_budget->setDbValue($row['project_budget']);
        $this->project_target->setDbValue($row['project_target']);
        $this->project_start->setDbValue($row['project_start']);
        $this->project_duration->setDbValue($row['project_duration']);
        $this->project_html->setDbValue($row['project_html']);
        $this->project_headgbr->setDbValue($row['project_headgbr']);
        $this->slug->setDbValue($row['slug']);
        $this->created_at->setDbValue($row['created_at']);
        $this->updated_at->setDbValue($row['updated_at']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['project_category_id'] = $this->project_category_id->DefaultValue;
        $row['project_provider_id'] = $this->project_provider_id->DefaultValue;
        $row['project_status_id'] = $this->project_status_id->DefaultValue;
        $row['funding_source_id'] = $this->funding_source_id->DefaultValue;
        $row['project_name'] = $this->project_name->DefaultValue;
        $row['project_description'] = $this->project_description->DefaultValue;
        $row['project_budget'] = $this->project_budget->DefaultValue;
        $row['project_target'] = $this->project_target->DefaultValue;
        $row['project_start'] = $this->project_start->DefaultValue;
        $row['project_duration'] = $this->project_duration->DefaultValue;
        $row['project_html'] = $this->project_html->DefaultValue;
        $row['project_headgbr'] = $this->project_headgbr->DefaultValue;
        $row['slug'] = $this->slug->DefaultValue;
        $row['created_at'] = $this->created_at->DefaultValue;
        $row['updated_at'] = $this->updated_at->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        if ($this->OldKey != "") {
            $this->setKey($this->OldKey);
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn);
            if ($rs && ($row = $rs->fields)) {
                $this->loadRowValues($row); // Load row values
                return $row;
            }
        }
        $this->loadRowValues(); // Load default row values
        return null;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->RowCssClass = "row";

        // project_category_id
        $this->project_category_id->RowCssClass = "row";

        // project_provider_id
        $this->project_provider_id->RowCssClass = "row";

        // project_status_id
        $this->project_status_id->RowCssClass = "row";

        // funding_source_id
        $this->funding_source_id->RowCssClass = "row";

        // project_name
        $this->project_name->RowCssClass = "row";

        // project_description
        $this->project_description->RowCssClass = "row";

        // project_budget
        $this->project_budget->RowCssClass = "row";

        // project_target
        $this->project_target->RowCssClass = "row";

        // project_start
        $this->project_start->RowCssClass = "row";

        // project_duration
        $this->project_duration->RowCssClass = "row";

        // project_html
        $this->project_html->RowCssClass = "row";

        // project_headgbr
        $this->project_headgbr->RowCssClass = "row";

        // slug
        $this->slug->RowCssClass = "row";

        // created_at
        $this->created_at->RowCssClass = "row";

        // updated_at
        $this->updated_at->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;

            // project_category_id
            $curVal = strval($this->project_category_id->CurrentValue);
            if ($curVal != "") {
                $this->project_category_id->ViewValue = $this->project_category_id->lookupCacheOption($curVal);
                if ($this->project_category_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`id`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->project_category_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->project_category_id->Lookup->renderViewRow($rswrk[0]);
                        $this->project_category_id->ViewValue = $this->project_category_id->displayValue($arwrk);
                    } else {
                        $this->project_category_id->ViewValue = FormatNumber($this->project_category_id->CurrentValue, $this->project_category_id->formatPattern());
                    }
                }
            } else {
                $this->project_category_id->ViewValue = null;
            }

            // project_provider_id
            $curVal = strval($this->project_provider_id->CurrentValue);
            if ($curVal != "") {
                $this->project_provider_id->ViewValue = $this->project_provider_id->lookupCacheOption($curVal);
                if ($this->project_provider_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`id`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->project_provider_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->project_provider_id->Lookup->renderViewRow($rswrk[0]);
                        $this->project_provider_id->ViewValue = $this->project_provider_id->displayValue($arwrk);
                    } else {
                        $this->project_provider_id->ViewValue = FormatNumber($this->project_provider_id->CurrentValue, $this->project_provider_id->formatPattern());
                    }
                }
            } else {
                $this->project_provider_id->ViewValue = null;
            }

            // project_status_id
            $curVal = strval($this->project_status_id->CurrentValue);
            if ($curVal != "") {
                $this->project_status_id->ViewValue = $this->project_status_id->lookupCacheOption($curVal);
                if ($this->project_status_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`id`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->project_status_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->project_status_id->Lookup->renderViewRow($rswrk[0]);
                        $this->project_status_id->ViewValue = $this->project_status_id->displayValue($arwrk);
                    } else {
                        $this->project_status_id->ViewValue = FormatNumber($this->project_status_id->CurrentValue, $this->project_status_id->formatPattern());
                    }
                }
            } else {
                $this->project_status_id->ViewValue = null;
            }

            // funding_source_id
            $this->funding_source_id->ViewValue = $this->funding_source_id->CurrentValue;
            $curVal = strval($this->funding_source_id->CurrentValue);
            if ($curVal != "") {
                $this->funding_source_id->ViewValue = $this->funding_source_id->lookupCacheOption($curVal);
                if ($this->funding_source_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`id`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->funding_source_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->funding_source_id->Lookup->renderViewRow($rswrk[0]);
                        $this->funding_source_id->ViewValue = $this->funding_source_id->displayValue($arwrk);
                    } else {
                        $this->funding_source_id->ViewValue = FormatNumber($this->funding_source_id->CurrentValue, $this->funding_source_id->formatPattern());
                    }
                }
            } else {
                $this->funding_source_id->ViewValue = null;
            }

            // project_name
            $this->project_name->ViewValue = $this->project_name->CurrentValue;

            // project_description
            $this->project_description->ViewValue = $this->project_description->CurrentValue;

            // project_budget
            $this->project_budget->ViewValue = $this->project_budget->CurrentValue;
            $this->project_budget->ViewValue = FormatNumber($this->project_budget->ViewValue, $this->project_budget->formatPattern());

            // project_target
            $this->project_target->ViewValue = $this->project_target->CurrentValue;

            // project_start
            $this->project_start->ViewValue = $this->project_start->CurrentValue;
            $this->project_start->ViewValue = FormatDateTime($this->project_start->ViewValue, $this->project_start->formatPattern());

            // project_duration
            $this->project_duration->ViewValue = $this->project_duration->CurrentValue;

            // project_html
            $this->project_html->ViewValue = $this->project_html->CurrentValue;

            // project_headgbr
            $this->project_headgbr->ViewValue = $this->project_headgbr->CurrentValue;

            // slug
            $this->slug->ViewValue = $this->slug->CurrentValue;

            // created_at
            $this->created_at->ViewValue = $this->created_at->CurrentValue;
            $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, $this->created_at->formatPattern());

            // updated_at
            $this->updated_at->ViewValue = $this->updated_at->CurrentValue;
            $this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, $this->updated_at->formatPattern());

            // id
            $this->id->HrefValue = "";

            // project_category_id
            $this->project_category_id->HrefValue = "";

            // project_provider_id
            $this->project_provider_id->HrefValue = "";

            // project_status_id
            $this->project_status_id->HrefValue = "";

            // funding_source_id
            $this->funding_source_id->HrefValue = "";

            // project_name
            $this->project_name->HrefValue = "";

            // project_description
            $this->project_description->HrefValue = "";

            // project_budget
            $this->project_budget->HrefValue = "";

            // project_target
            $this->project_target->HrefValue = "";

            // project_start
            $this->project_start->HrefValue = "";

            // project_duration
            $this->project_duration->HrefValue = "";

            // project_html
            $this->project_html->HrefValue = "";

            // project_headgbr
            $this->project_headgbr->HrefValue = "";

            // slug
            $this->slug->HrefValue = "";
            $this->slug->TooltipValue = "";

            // created_at
            $this->created_at->HrefValue = "";

            // updated_at
            $this->updated_at->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditValue = $this->id->CurrentValue;

            // project_category_id
            $this->project_category_id->setupEditAttributes();
            $curVal = trim(strval($this->project_category_id->CurrentValue));
            if ($curVal != "") {
                $this->project_category_id->ViewValue = $this->project_category_id->lookupCacheOption($curVal);
            } else {
                $this->project_category_id->ViewValue = $this->project_category_id->Lookup !== null && is_array($this->project_category_id->lookupOptions()) && count($this->project_category_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->project_category_id->ViewValue !== null) { // Load from cache
                $this->project_category_id->EditValue = array_values($this->project_category_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter("`id`", "=", $this->project_category_id->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->project_category_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->project_category_id->EditValue = $arwrk;
            }
            $this->project_category_id->PlaceHolder = RemoveHtml($this->project_category_id->caption());

            // project_provider_id
            $this->project_provider_id->setupEditAttributes();
            $curVal = trim(strval($this->project_provider_id->CurrentValue));
            if ($curVal != "") {
                $this->project_provider_id->ViewValue = $this->project_provider_id->lookupCacheOption($curVal);
            } else {
                $this->project_provider_id->ViewValue = $this->project_provider_id->Lookup !== null && is_array($this->project_provider_id->lookupOptions()) && count($this->project_provider_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->project_provider_id->ViewValue !== null) { // Load from cache
                $this->project_provider_id->EditValue = array_values($this->project_provider_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter("`id`", "=", $this->project_provider_id->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->project_provider_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->project_provider_id->EditValue = $arwrk;
            }
            $this->project_provider_id->PlaceHolder = RemoveHtml($this->project_provider_id->caption());

            // project_status_id
            $this->project_status_id->setupEditAttributes();
            $curVal = trim(strval($this->project_status_id->CurrentValue));
            if ($curVal != "") {
                $this->project_status_id->ViewValue = $this->project_status_id->lookupCacheOption($curVal);
            } else {
                $this->project_status_id->ViewValue = $this->project_status_id->Lookup !== null && is_array($this->project_status_id->lookupOptions()) && count($this->project_status_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->project_status_id->ViewValue !== null) { // Load from cache
                $this->project_status_id->EditValue = array_values($this->project_status_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter("`id`", "=", $this->project_status_id->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->project_status_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->project_status_id->EditValue = $arwrk;
            }
            $this->project_status_id->PlaceHolder = RemoveHtml($this->project_status_id->caption());

            // funding_source_id
            $this->funding_source_id->setupEditAttributes();
            $this->funding_source_id->EditValue = HtmlEncode($this->funding_source_id->CurrentValue);
            $curVal = strval($this->funding_source_id->CurrentValue);
            if ($curVal != "") {
                $this->funding_source_id->EditValue = $this->funding_source_id->lookupCacheOption($curVal);
                if ($this->funding_source_id->EditValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`id`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->funding_source_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->funding_source_id->Lookup->renderViewRow($rswrk[0]);
                        $this->funding_source_id->EditValue = $this->funding_source_id->displayValue($arwrk);
                    } else {
                        $this->funding_source_id->EditValue = HtmlEncode(FormatNumber($this->funding_source_id->CurrentValue, $this->funding_source_id->formatPattern()));
                    }
                }
            } else {
                $this->funding_source_id->EditValue = null;
            }
            $this->funding_source_id->PlaceHolder = RemoveHtml($this->funding_source_id->caption());

            // project_name
            $this->project_name->setupEditAttributes();
            if (!$this->project_name->Raw) {
                $this->project_name->CurrentValue = HtmlDecode($this->project_name->CurrentValue);
            }
            $this->project_name->EditValue = HtmlEncode($this->project_name->CurrentValue);
            $this->project_name->PlaceHolder = RemoveHtml($this->project_name->caption());

            // project_description
            $this->project_description->setupEditAttributes();
            $this->project_description->EditValue = HtmlEncode($this->project_description->CurrentValue);
            $this->project_description->PlaceHolder = RemoveHtml($this->project_description->caption());

            // project_budget
            $this->project_budget->setupEditAttributes();
            $this->project_budget->EditValue = HtmlEncode($this->project_budget->CurrentValue);
            $this->project_budget->PlaceHolder = RemoveHtml($this->project_budget->caption());
            if (strval($this->project_budget->EditValue) != "" && is_numeric($this->project_budget->EditValue)) {
                $this->project_budget->EditValue = FormatNumber($this->project_budget->EditValue, null);
            }

            // project_target
            $this->project_target->setupEditAttributes();
            $this->project_target->EditValue = HtmlEncode($this->project_target->CurrentValue);
            $this->project_target->PlaceHolder = RemoveHtml($this->project_target->caption());

            // project_start
            $this->project_start->setupEditAttributes();
            $this->project_start->EditValue = HtmlEncode(FormatDateTime($this->project_start->CurrentValue, $this->project_start->formatPattern()));
            $this->project_start->PlaceHolder = RemoveHtml($this->project_start->caption());

            // project_duration
            $this->project_duration->setupEditAttributes();
            if (!$this->project_duration->Raw) {
                $this->project_duration->CurrentValue = HtmlDecode($this->project_duration->CurrentValue);
            }
            $this->project_duration->EditValue = HtmlEncode($this->project_duration->CurrentValue);
            $this->project_duration->PlaceHolder = RemoveHtml($this->project_duration->caption());

            // project_html
            $this->project_html->setupEditAttributes();
            $this->project_html->EditValue = HtmlEncode($this->project_html->CurrentValue);
            $this->project_html->PlaceHolder = RemoveHtml($this->project_html->caption());

            // project_headgbr
            $this->project_headgbr->setupEditAttributes();
            $this->project_headgbr->EditValue = HtmlEncode($this->project_headgbr->CurrentValue);
            $this->project_headgbr->PlaceHolder = RemoveHtml($this->project_headgbr->caption());

            // slug
            $this->slug->setupEditAttributes();
            $this->slug->EditValue = $this->slug->CurrentValue;

            // created_at
            $this->created_at->setupEditAttributes();
            $this->created_at->EditValue = HtmlEncode(FormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern()));
            $this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

            // updated_at
            $this->updated_at->setupEditAttributes();
            $this->updated_at->EditValue = HtmlEncode(FormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern()));
            $this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

            // Edit refer script

            // id
            $this->id->HrefValue = "";

            // project_category_id
            $this->project_category_id->HrefValue = "";

            // project_provider_id
            $this->project_provider_id->HrefValue = "";

            // project_status_id
            $this->project_status_id->HrefValue = "";

            // funding_source_id
            $this->funding_source_id->HrefValue = "";

            // project_name
            $this->project_name->HrefValue = "";

            // project_description
            $this->project_description->HrefValue = "";

            // project_budget
            $this->project_budget->HrefValue = "";

            // project_target
            $this->project_target->HrefValue = "";

            // project_start
            $this->project_start->HrefValue = "";

            // project_duration
            $this->project_duration->HrefValue = "";

            // project_html
            $this->project_html->HrefValue = "";

            // project_headgbr
            $this->project_headgbr->HrefValue = "";

            // slug
            $this->slug->HrefValue = "";
            $this->slug->TooltipValue = "";

            // created_at
            $this->created_at->HrefValue = "";

            // updated_at
            $this->updated_at->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language, $Security;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->id->Visible && $this->id->Required) {
            if (!$this->id->IsDetailKey && EmptyValue($this->id->FormValue)) {
                $this->id->addErrorMessage(str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
            }
        }
        if ($this->project_category_id->Visible && $this->project_category_id->Required) {
            if (!$this->project_category_id->IsDetailKey && EmptyValue($this->project_category_id->FormValue)) {
                $this->project_category_id->addErrorMessage(str_replace("%s", $this->project_category_id->caption(), $this->project_category_id->RequiredErrorMessage));
            }
        }
        if ($this->project_provider_id->Visible && $this->project_provider_id->Required) {
            if (!$this->project_provider_id->IsDetailKey && EmptyValue($this->project_provider_id->FormValue)) {
                $this->project_provider_id->addErrorMessage(str_replace("%s", $this->project_provider_id->caption(), $this->project_provider_id->RequiredErrorMessage));
            }
        }
        if ($this->project_status_id->Visible && $this->project_status_id->Required) {
            if (!$this->project_status_id->IsDetailKey && EmptyValue($this->project_status_id->FormValue)) {
                $this->project_status_id->addErrorMessage(str_replace("%s", $this->project_status_id->caption(), $this->project_status_id->RequiredErrorMessage));
            }
        }
        if ($this->funding_source_id->Visible && $this->funding_source_id->Required) {
            if (!$this->funding_source_id->IsDetailKey && EmptyValue($this->funding_source_id->FormValue)) {
                $this->funding_source_id->addErrorMessage(str_replace("%s", $this->funding_source_id->caption(), $this->funding_source_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->funding_source_id->FormValue)) {
            $this->funding_source_id->addErrorMessage($this->funding_source_id->getErrorMessage(false));
        }
        if ($this->project_name->Visible && $this->project_name->Required) {
            if (!$this->project_name->IsDetailKey && EmptyValue($this->project_name->FormValue)) {
                $this->project_name->addErrorMessage(str_replace("%s", $this->project_name->caption(), $this->project_name->RequiredErrorMessage));
            }
        }
        if ($this->project_description->Visible && $this->project_description->Required) {
            if (!$this->project_description->IsDetailKey && EmptyValue($this->project_description->FormValue)) {
                $this->project_description->addErrorMessage(str_replace("%s", $this->project_description->caption(), $this->project_description->RequiredErrorMessage));
            }
        }
        if ($this->project_budget->Visible && $this->project_budget->Required) {
            if (!$this->project_budget->IsDetailKey && EmptyValue($this->project_budget->FormValue)) {
                $this->project_budget->addErrorMessage(str_replace("%s", $this->project_budget->caption(), $this->project_budget->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->project_budget->FormValue)) {
            $this->project_budget->addErrorMessage($this->project_budget->getErrorMessage(false));
        }
        if ($this->project_target->Visible && $this->project_target->Required) {
            if (!$this->project_target->IsDetailKey && EmptyValue($this->project_target->FormValue)) {
                $this->project_target->addErrorMessage(str_replace("%s", $this->project_target->caption(), $this->project_target->RequiredErrorMessage));
            }
        }
        if ($this->project_start->Visible && $this->project_start->Required) {
            if (!$this->project_start->IsDetailKey && EmptyValue($this->project_start->FormValue)) {
                $this->project_start->addErrorMessage(str_replace("%s", $this->project_start->caption(), $this->project_start->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->project_start->FormValue, $this->project_start->formatPattern())) {
            $this->project_start->addErrorMessage($this->project_start->getErrorMessage(false));
        }
        if ($this->project_duration->Visible && $this->project_duration->Required) {
            if (!$this->project_duration->IsDetailKey && EmptyValue($this->project_duration->FormValue)) {
                $this->project_duration->addErrorMessage(str_replace("%s", $this->project_duration->caption(), $this->project_duration->RequiredErrorMessage));
            }
        }
        if ($this->project_html->Visible && $this->project_html->Required) {
            if (!$this->project_html->IsDetailKey && EmptyValue($this->project_html->FormValue)) {
                $this->project_html->addErrorMessage(str_replace("%s", $this->project_html->caption(), $this->project_html->RequiredErrorMessage));
            }
        }
        if ($this->project_headgbr->Visible && $this->project_headgbr->Required) {
            if (!$this->project_headgbr->IsDetailKey && EmptyValue($this->project_headgbr->FormValue)) {
                $this->project_headgbr->addErrorMessage(str_replace("%s", $this->project_headgbr->caption(), $this->project_headgbr->RequiredErrorMessage));
            }
        }
        if ($this->slug->Visible && $this->slug->Required) {
            if (!$this->slug->IsDetailKey && EmptyValue($this->slug->FormValue)) {
                $this->slug->addErrorMessage(str_replace("%s", $this->slug->caption(), $this->slug->RequiredErrorMessage));
            }
        }
        if ($this->created_at->Visible && $this->created_at->Required) {
            if (!$this->created_at->IsDetailKey && EmptyValue($this->created_at->FormValue)) {
                $this->created_at->addErrorMessage(str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->created_at->FormValue, $this->created_at->formatPattern())) {
            $this->created_at->addErrorMessage($this->created_at->getErrorMessage(false));
        }
        if ($this->updated_at->Visible && $this->updated_at->Required) {
            if (!$this->updated_at->IsDetailKey && EmptyValue($this->updated_at->FormValue)) {
                $this->updated_at->addErrorMessage(str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->updated_at->FormValue, $this->updated_at->formatPattern())) {
            $this->updated_at->addErrorMessage($this->updated_at->getErrorMessage(false));
        }

        // Validate detail grid
        $detailTblVar = explode(",", $this->getCurrentDetailTable());
        $detailPage = Container("ProjectInvestorsGrid");
        if (in_array("project_investors", $detailTblVar) && $detailPage->DetailEdit) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("ProjectFilesGrid");
        if (in_array("project_files", $detailTblVar) && $detailPage->DetailEdit) {
            $detailPage->run();
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
        }

        // Set new row
        $rsnew = [];

        // project_category_id
        $this->project_category_id->setDbValueDef($rsnew, $this->project_category_id->CurrentValue, $this->project_category_id->ReadOnly);

        // project_provider_id
        $this->project_provider_id->setDbValueDef($rsnew, $this->project_provider_id->CurrentValue, $this->project_provider_id->ReadOnly);

        // project_status_id
        $this->project_status_id->setDbValueDef($rsnew, $this->project_status_id->CurrentValue, $this->project_status_id->ReadOnly);

        // funding_source_id
        $this->funding_source_id->setDbValueDef($rsnew, $this->funding_source_id->CurrentValue, $this->funding_source_id->ReadOnly);

        // project_name
        $this->project_name->setDbValueDef($rsnew, $this->project_name->CurrentValue, $this->project_name->ReadOnly);

        // project_description
        $this->project_description->setDbValueDef($rsnew, $this->project_description->CurrentValue, $this->project_description->ReadOnly);

        // project_budget
        $this->project_budget->setDbValueDef($rsnew, $this->project_budget->CurrentValue, $this->project_budget->ReadOnly);

        // project_target
        $this->project_target->setDbValueDef($rsnew, $this->project_target->CurrentValue, $this->project_target->ReadOnly);

        // project_start
        $this->project_start->setDbValueDef($rsnew, UnFormatDateTime($this->project_start->CurrentValue, $this->project_start->formatPattern()), $this->project_start->ReadOnly);

        // project_duration
        $this->project_duration->setDbValueDef($rsnew, $this->project_duration->CurrentValue, $this->project_duration->ReadOnly);

        // project_html
        $this->project_html->setDbValueDef($rsnew, $this->project_html->CurrentValue, $this->project_html->ReadOnly);

        // project_headgbr
        $this->project_headgbr->setDbValueDef($rsnew, $this->project_headgbr->CurrentValue, $this->project_headgbr->ReadOnly);

        // created_at
        $this->created_at->setDbValueDef($rsnew, UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern()), $this->created_at->ReadOnly);

        // updated_at
        $this->updated_at->setDbValueDef($rsnew, UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern()), $this->updated_at->ReadOnly);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check field with unique index (slug)
        if ($this->slug->CurrentValue != "") {
            $filterChk = "(`slug` = '" . AdjustSql($this->slug->CurrentValue, $this->Dbid) . "')";
            $filterChk .= " AND NOT (" . $filter . ")";
            $this->CurrentFilter = $filterChk;
            $sqlChk = $this->getCurrentSql();
            $rsChk = $conn->executeQuery($sqlChk);
            if (!$rsChk) {
                return false;
            }
            if ($rsChk->fetch()) {
                $idxErrMsg = str_replace("%f", $this->slug->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->slug->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }

        // Begin transaction
        if ($this->getCurrentDetailTable() != "" && $this->UseTransaction) {
            $conn->beginTransaction();
        }

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
                if (!$editRow && !EmptyValue($this->DbErrorMessage)) { // Show database error
                    $this->setFailureMessage($this->DbErrorMessage);
                }
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
            }

            // Update detail records
            $detailTblVar = explode(",", $this->getCurrentDetailTable());
            if ($editRow) {
                $detailPage = Container("ProjectInvestorsGrid");
                if (in_array("project_investors", $detailTblVar) && $detailPage->DetailEdit) {
                    $editRow = $detailPage->gridUpdate();
                }
            }
            if ($editRow) {
                $detailPage = Container("ProjectFilesGrid");
                if (in_array("project_files", $detailTblVar) && $detailPage->DetailEdit) {
                    $editRow = $detailPage->gridUpdate();
                }
            }

            // Commit/Rollback transaction
            if ($this->getCurrentDetailTable() != "") {
                if ($editRow) {
                    if ($this->UseTransaction) { // Commit transaction
                        $conn->commit();
                    }
                } else {
                    if ($this->UseTransaction) { // Rollback transaction
                        $conn->rollback();
                    }
                }
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_EDIT_ACTION"), $table => $row]);
        }
        return $editRow;
    }

    // Set up detail parms based on QueryString
    protected function setupDetailParms()
    {
        // Get the keys for master table
        $detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
        if ($detailTblVar !== null) {
            $this->setCurrentDetailTable($detailTblVar);
        } else {
            $detailTblVar = $this->getCurrentDetailTable();
        }
        if ($detailTblVar != "") {
            $detailTblVar = explode(",", $detailTblVar);
            if (in_array("project_investors", $detailTblVar)) {
                $detailPageObj = Container("ProjectInvestorsGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->project_id->IsDetailKey = true;
                    $detailPageObj->project_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->project_id->setSessionValue($detailPageObj->project_id->CurrentValue);
                }
            }
            if (in_array("project_files", $detailTblVar)) {
                $detailPageObj = Container("ProjectFilesGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->project_id->IsDetailKey = true;
                    $detailPageObj->project_id->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->project_id->setSessionValue($detailPageObj->project_id->CurrentValue);
                }
            }
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ProjectsList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Set up detail pages
    protected function setupDetailPages()
    {
        $pages = new SubPages();
        $pages->Style = "pills";
        $pages->add('project_investors');
        $pages->add('project_files');
        $this->DetailPages = $pages;
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_project_category_id":
                    break;
                case "x_project_provider_id":
                    break;
                case "x_project_status_id":
                    break;
                case "x_funding_source_id":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0 && count($fld->Lookup->FilterFields) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        $pageNo = Get(Config("TABLE_PAGE_NUMBER"));
        $startRec = Get(Config("TABLE_START_REC"));
        $infiniteScroll = false;
        $recordNo = $pageNo ?? $startRec; // Record number = page number or start record
        if ($recordNo !== null && is_numeric($recordNo)) {
            $this->StartRecord = $recordNo;
        } else {
            $this->StartRecord = $this->getStartRecordNumber();
        }

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || intval($this->StartRecord) <= 0) { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
        }
        if (!$infiniteScroll) {
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Get page count
    public function pageCount() {
        return ceil($this->TotalRecords / $this->DisplayRecords);
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"break-after:page;\"></div>"; // Modify page break content
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
