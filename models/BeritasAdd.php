<?php

namespace PHPMaker2023\crudperumdautama;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class BeritasAdd extends Beritas
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "BeritasAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "BeritasAdd";

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
        $this->id->Visible = false;
        $this->judul->setVisibility();
        $this->kategori_berita_id->setVisibility();
        $this->tanggal_terbit->setVisibility();
        $this->excerpts->setVisibility();
        $this->slug->setVisibility();
        $this->author->setVisibility();
        $this->isi_berita->setVisibility();
        $this->gbr_berita->setVisibility();
        $this->headline->setVisibility();
        $this->created_at->setVisibility();
        $this->updated_at->setVisibility();
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer;
        $this->TableVar = 'beritas';
        $this->TableName = 'beritas';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (beritas)
        if (!isset($GLOBALS["beritas"]) || get_class($GLOBALS["beritas"]) == PROJECT_NAMESPACE . "beritas") {
            $GLOBALS["beritas"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'beritas');
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
                    $result["view"] = $pageName == "BeritasView"; // If View page, no primary button
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
                $this->gbr_berita->OldUploadPath = $this->gbr_berita->getUploadPath(); // PHP
                $this->gbr_berita->UploadPath = $this->gbr_berita->OldUploadPath;
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
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $CopyRecord;

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

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

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
        $this->setupLookupOptions($this->kategori_berita_id);
        $this->setupLookupOptions($this->headline);

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action", "") !== "") {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
                $this->setKey($this->OldKey); // Set up record key
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record or default values
        $rsold = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$rsold) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("BeritasList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($rsold)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "BeritasList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "BeritasView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "BeritasList") {
                            Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "BeritasList"; // Return list page content
                        }
                    }
                    if (IsJsonResponse()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
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
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
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
        $this->gbr_berita->Upload->Index = $CurrentForm->Index;
        $this->gbr_berita->Upload->uploadFile();
        $this->gbr_berita->CurrentValue = $this->gbr_berita->Upload->FileName;
    }

    // Load default values
    protected function loadDefaultValues()
    {
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'judul' first before field var 'x_judul'
        $val = $CurrentForm->hasValue("judul") ? $CurrentForm->getValue("judul") : $CurrentForm->getValue("x_judul");
        if (!$this->judul->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->judul->Visible = false; // Disable update for API request
            } else {
                $this->judul->setFormValue($val);
            }
        }

        // Check field name 'kategori_berita_id' first before field var 'x_kategori_berita_id'
        $val = $CurrentForm->hasValue("kategori_berita_id") ? $CurrentForm->getValue("kategori_berita_id") : $CurrentForm->getValue("x_kategori_berita_id");
        if (!$this->kategori_berita_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kategori_berita_id->Visible = false; // Disable update for API request
            } else {
                $this->kategori_berita_id->setFormValue($val);
            }
        }

        // Check field name 'tanggal_terbit' first before field var 'x_tanggal_terbit'
        $val = $CurrentForm->hasValue("tanggal_terbit") ? $CurrentForm->getValue("tanggal_terbit") : $CurrentForm->getValue("x_tanggal_terbit");
        if (!$this->tanggal_terbit->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggal_terbit->Visible = false; // Disable update for API request
            } else {
                $this->tanggal_terbit->setFormValue($val, true, $validate);
            }
            $this->tanggal_terbit->CurrentValue = UnFormatDateTime($this->tanggal_terbit->CurrentValue, $this->tanggal_terbit->formatPattern());
        }

        // Check field name 'excerpts' first before field var 'x_excerpts'
        $val = $CurrentForm->hasValue("excerpts") ? $CurrentForm->getValue("excerpts") : $CurrentForm->getValue("x_excerpts");
        if (!$this->excerpts->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->excerpts->Visible = false; // Disable update for API request
            } else {
                $this->excerpts->setFormValue($val);
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

        // Check field name 'author' first before field var 'x_author'
        $val = $CurrentForm->hasValue("author") ? $CurrentForm->getValue("author") : $CurrentForm->getValue("x_author");
        if (!$this->author->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->author->Visible = false; // Disable update for API request
            } else {
                $this->author->setFormValue($val);
            }
        }

        // Check field name 'isi_berita' first before field var 'x_isi_berita'
        $val = $CurrentForm->hasValue("isi_berita") ? $CurrentForm->getValue("isi_berita") : $CurrentForm->getValue("x_isi_berita");
        if (!$this->isi_berita->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->isi_berita->Visible = false; // Disable update for API request
            } else {
                $this->isi_berita->setFormValue($val);
            }
        }

        // Check field name 'headline' first before field var 'x_headline'
        $val = $CurrentForm->hasValue("headline") ? $CurrentForm->getValue("headline") : $CurrentForm->getValue("x_headline");
        if (!$this->headline->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->headline->Visible = false; // Disable update for API request
            } else {
                $this->headline->setFormValue($val);
            }
        }

        // Check field name 'created_at' first before field var 'x_created_at'
        $val = $CurrentForm->hasValue("created_at") ? $CurrentForm->getValue("created_at") : $CurrentForm->getValue("x_created_at");
        if (!$this->created_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->created_at->Visible = false; // Disable update for API request
            } else {
                $this->created_at->setFormValue($val);
            }
            $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        }

        // Check field name 'updated_at' first before field var 'x_updated_at'
        $val = $CurrentForm->hasValue("updated_at") ? $CurrentForm->getValue("updated_at") : $CurrentForm->getValue("x_updated_at");
        if (!$this->updated_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->updated_at->Visible = false; // Disable update for API request
            } else {
                $this->updated_at->setFormValue($val);
            }
            $this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		$this->gbr_berita->OldUploadPath = $this->gbr_berita->getUploadPath(); // PHP
		$this->gbr_berita->UploadPath = $this->gbr_berita->OldUploadPath;
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->judul->CurrentValue = $this->judul->FormValue;
        $this->kategori_berita_id->CurrentValue = $this->kategori_berita_id->FormValue;
        $this->tanggal_terbit->CurrentValue = $this->tanggal_terbit->FormValue;
        $this->tanggal_terbit->CurrentValue = UnFormatDateTime($this->tanggal_terbit->CurrentValue, $this->tanggal_terbit->formatPattern());
        $this->excerpts->CurrentValue = $this->excerpts->FormValue;
        $this->slug->CurrentValue = $this->slug->FormValue;
        $this->author->CurrentValue = $this->author->FormValue;
        $this->isi_berita->CurrentValue = $this->isi_berita->FormValue;
        $this->headline->CurrentValue = $this->headline->FormValue;
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
        $this->judul->setDbValue($row['judul']);
        $this->kategori_berita_id->setDbValue($row['kategori_berita_id']);
        $this->tanggal_terbit->setDbValue($row['tanggal_terbit']);
        $this->excerpts->setDbValue($row['excerpts']);
        $this->slug->setDbValue($row['slug']);
        $this->author->setDbValue($row['author']);
        $this->isi_berita->setDbValue($row['isi_berita']);
        $this->gbr_berita->Upload->DbValue = $row['gbr_berita'];
        $this->gbr_berita->setDbValue($this->gbr_berita->Upload->DbValue);
        $this->headline->setDbValue($row['headline']);
        $this->created_at->setDbValue($row['created_at']);
        $this->updated_at->setDbValue($row['updated_at']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['judul'] = $this->judul->DefaultValue;
        $row['kategori_berita_id'] = $this->kategori_berita_id->DefaultValue;
        $row['tanggal_terbit'] = $this->tanggal_terbit->DefaultValue;
        $row['excerpts'] = $this->excerpts->DefaultValue;
        $row['slug'] = $this->slug->DefaultValue;
        $row['author'] = $this->author->DefaultValue;
        $row['isi_berita'] = $this->isi_berita->DefaultValue;
        $row['gbr_berita'] = $this->gbr_berita->DefaultValue;
        $row['headline'] = $this->headline->DefaultValue;
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

        // judul
        $this->judul->RowCssClass = "row";

        // kategori_berita_id
        $this->kategori_berita_id->RowCssClass = "row";

        // tanggal_terbit
        $this->tanggal_terbit->RowCssClass = "row";

        // excerpts
        $this->excerpts->RowCssClass = "row";

        // slug
        $this->slug->RowCssClass = "row";

        // author
        $this->author->RowCssClass = "row";

        // isi_berita
        $this->isi_berita->RowCssClass = "row";

        // gbr_berita
        $this->gbr_berita->RowCssClass = "row";

        // headline
        $this->headline->RowCssClass = "row";

        // created_at
        $this->created_at->RowCssClass = "row";

        // updated_at
        $this->updated_at->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;

            // judul
            $this->judul->ViewValue = $this->judul->CurrentValue;

            // kategori_berita_id
            $curVal = strval($this->kategori_berita_id->CurrentValue);
            if ($curVal != "") {
                $this->kategori_berita_id->ViewValue = $this->kategori_berita_id->lookupCacheOption($curVal);
                if ($this->kategori_berita_id->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`id`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->kategori_berita_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->kategori_berita_id->Lookup->renderViewRow($rswrk[0]);
                        $this->kategori_berita_id->ViewValue = $this->kategori_berita_id->displayValue($arwrk);
                    } else {
                        $this->kategori_berita_id->ViewValue = FormatNumber($this->kategori_berita_id->CurrentValue, $this->kategori_berita_id->formatPattern());
                    }
                }
            } else {
                $this->kategori_berita_id->ViewValue = null;
            }

            // tanggal_terbit
            $this->tanggal_terbit->ViewValue = $this->tanggal_terbit->CurrentValue;
            $this->tanggal_terbit->ViewValue = FormatDateTime($this->tanggal_terbit->ViewValue, $this->tanggal_terbit->formatPattern());

            // excerpts
            $this->excerpts->ViewValue = $this->excerpts->CurrentValue;

            // slug
            $this->slug->ViewValue = $this->slug->CurrentValue;

            // author
            $this->author->ViewValue = $this->author->CurrentValue;

            // isi_berita
            $this->isi_berita->ViewValue = $this->isi_berita->CurrentValue;

            // gbr_berita
            $this->gbr_berita->UploadPath = $this->gbr_berita->getUploadPath(); // PHP
            if (!EmptyValue($this->gbr_berita->Upload->DbValue)) {
                $this->gbr_berita->ImageWidth = 200;
                $this->gbr_berita->ImageHeight = 0;
                $this->gbr_berita->ImageAlt = $this->gbr_berita->alt();
                $this->gbr_berita->ImageCssClass = "ew-image";
                $this->gbr_berita->ViewValue = $this->gbr_berita->Upload->DbValue;
            } else {
                $this->gbr_berita->ViewValue = "";
            }

            // headline
            if (ConvertToBool($this->headline->CurrentValue)) {
                $this->headline->ViewValue = $this->headline->tagCaption(1) != "" ? $this->headline->tagCaption(1) : "Ya";
            } else {
                $this->headline->ViewValue = $this->headline->tagCaption(2) != "" ? $this->headline->tagCaption(2) : "Tidak";
            }

            // created_at
            $this->created_at->ViewValue = $this->created_at->CurrentValue;
            $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, $this->created_at->formatPattern());

            // updated_at
            $this->updated_at->ViewValue = $this->updated_at->CurrentValue;
            $this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, $this->updated_at->formatPattern());

            // judul
            $this->judul->HrefValue = "";

            // kategori_berita_id
            $this->kategori_berita_id->HrefValue = "";

            // tanggal_terbit
            $this->tanggal_terbit->HrefValue = "";

            // excerpts
            $this->excerpts->HrefValue = "";

            // slug
            $this->slug->HrefValue = "";

            // author
            $this->author->HrefValue = "";

            // isi_berita
            $this->isi_berita->HrefValue = "";

            // gbr_berita
            $this->gbr_berita->UploadPath = $this->gbr_berita->getUploadPath(); // PHP
            if (!EmptyValue($this->gbr_berita->Upload->DbValue)) {
                $this->gbr_berita->HrefValue = GetFileUploadUrl($this->gbr_berita, $this->gbr_berita->htmlDecode($this->gbr_berita->Upload->DbValue)); // Add prefix/suffix
                $this->gbr_berita->LinkAttrs["target"] = "_blank"; // Add target
                if ($this->isExport()) {
                    $this->gbr_berita->HrefValue = FullUrl($this->gbr_berita->HrefValue, "href");
                }
            } else {
                $this->gbr_berita->HrefValue = "";
            }
            $this->gbr_berita->ExportHrefValue = $this->gbr_berita->UploadPath . $this->gbr_berita->Upload->DbValue;

            // headline
            $this->headline->HrefValue = "";

            // created_at
            $this->created_at->HrefValue = "";

            // updated_at
            $this->updated_at->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // judul
            $this->judul->setupEditAttributes();
            if (!$this->judul->Raw) {
                $this->judul->CurrentValue = HtmlDecode($this->judul->CurrentValue);
            }
            $this->judul->EditValue = HtmlEncode($this->judul->CurrentValue);
            $this->judul->PlaceHolder = RemoveHtml($this->judul->caption());

            // kategori_berita_id
            $this->kategori_berita_id->setupEditAttributes();
            $curVal = trim(strval($this->kategori_berita_id->CurrentValue));
            if ($curVal != "") {
                $this->kategori_berita_id->ViewValue = $this->kategori_berita_id->lookupCacheOption($curVal);
            } else {
                $this->kategori_berita_id->ViewValue = $this->kategori_berita_id->Lookup !== null && is_array($this->kategori_berita_id->lookupOptions()) && count($this->kategori_berita_id->lookupOptions()) > 0 ? $curVal : null;
            }
            if ($this->kategori_berita_id->ViewValue !== null) { // Load from cache
                $this->kategori_berita_id->EditValue = array_values($this->kategori_berita_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter("`id`", "=", $this->kategori_berita_id->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->kategori_berita_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->kategori_berita_id->EditValue = $arwrk;
            }
            $this->kategori_berita_id->PlaceHolder = RemoveHtml($this->kategori_berita_id->caption());

            // tanggal_terbit
            $this->tanggal_terbit->setupEditAttributes();
            $this->tanggal_terbit->EditValue = HtmlEncode(FormatDateTime($this->tanggal_terbit->CurrentValue, $this->tanggal_terbit->formatPattern()));
            $this->tanggal_terbit->PlaceHolder = RemoveHtml($this->tanggal_terbit->caption());

            // excerpts
            $this->excerpts->setupEditAttributes();
            $this->excerpts->EditValue = HtmlEncode($this->excerpts->CurrentValue);
            $this->excerpts->PlaceHolder = RemoveHtml($this->excerpts->caption());

            // slug
            $this->slug->setupEditAttributes();
            if (!$this->slug->Raw) {
                $this->slug->CurrentValue = HtmlDecode($this->slug->CurrentValue);
            }
            $this->slug->EditValue = HtmlEncode($this->slug->CurrentValue);
            $this->slug->PlaceHolder = RemoveHtml($this->slug->caption());

            // author
            $this->author->setupEditAttributes();
            if (!$this->author->Raw) {
                $this->author->CurrentValue = HtmlDecode($this->author->CurrentValue);
            }
            $this->author->EditValue = HtmlEncode($this->author->CurrentValue);
            $this->author->PlaceHolder = RemoveHtml($this->author->caption());

            // isi_berita
            $this->isi_berita->setupEditAttributes();
            $this->isi_berita->EditValue = HtmlEncode($this->isi_berita->CurrentValue);
            $this->isi_berita->PlaceHolder = RemoveHtml($this->isi_berita->caption());

            // gbr_berita
            $this->gbr_berita->setupEditAttributes();
            $this->gbr_berita->UploadPath = $this->gbr_berita->getUploadPath(); // PHP
            if (!EmptyValue($this->gbr_berita->Upload->DbValue)) {
                $this->gbr_berita->ImageWidth = 200;
                $this->gbr_berita->ImageHeight = 0;
                $this->gbr_berita->ImageAlt = $this->gbr_berita->alt();
                $this->gbr_berita->ImageCssClass = "ew-image";
                $this->gbr_berita->EditValue = $this->gbr_berita->Upload->DbValue;
            } else {
                $this->gbr_berita->EditValue = "";
            }
            if (!EmptyValue($this->gbr_berita->CurrentValue)) {
                $this->gbr_berita->Upload->FileName = $this->gbr_berita->CurrentValue;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->gbr_berita);
            }

            // headline
            $this->headline->EditValue = $this->headline->options(false);
            $this->headline->PlaceHolder = RemoveHtml($this->headline->caption());

            // created_at

            // updated_at

            // Add refer script

            // judul
            $this->judul->HrefValue = "";

            // kategori_berita_id
            $this->kategori_berita_id->HrefValue = "";

            // tanggal_terbit
            $this->tanggal_terbit->HrefValue = "";

            // excerpts
            $this->excerpts->HrefValue = "";

            // slug
            $this->slug->HrefValue = "";

            // author
            $this->author->HrefValue = "";

            // isi_berita
            $this->isi_berita->HrefValue = "";

            // gbr_berita
            $this->gbr_berita->UploadPath = $this->gbr_berita->getUploadPath(); // PHP
            if (!EmptyValue($this->gbr_berita->Upload->DbValue)) {
                $this->gbr_berita->HrefValue = GetFileUploadUrl($this->gbr_berita, $this->gbr_berita->htmlDecode($this->gbr_berita->Upload->DbValue)); // Add prefix/suffix
                $this->gbr_berita->LinkAttrs["target"] = "_blank"; // Add target
                if ($this->isExport()) {
                    $this->gbr_berita->HrefValue = FullUrl($this->gbr_berita->HrefValue, "href");
                }
            } else {
                $this->gbr_berita->HrefValue = "";
            }
            $this->gbr_berita->ExportHrefValue = $this->gbr_berita->UploadPath . $this->gbr_berita->Upload->DbValue;

            // headline
            $this->headline->HrefValue = "";

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
        if ($this->judul->Visible && $this->judul->Required) {
            if (!$this->judul->IsDetailKey && EmptyValue($this->judul->FormValue)) {
                $this->judul->addErrorMessage(str_replace("%s", $this->judul->caption(), $this->judul->RequiredErrorMessage));
            }
        }
        if ($this->kategori_berita_id->Visible && $this->kategori_berita_id->Required) {
            if (!$this->kategori_berita_id->IsDetailKey && EmptyValue($this->kategori_berita_id->FormValue)) {
                $this->kategori_berita_id->addErrorMessage(str_replace("%s", $this->kategori_berita_id->caption(), $this->kategori_berita_id->RequiredErrorMessage));
            }
        }
        if ($this->tanggal_terbit->Visible && $this->tanggal_terbit->Required) {
            if (!$this->tanggal_terbit->IsDetailKey && EmptyValue($this->tanggal_terbit->FormValue)) {
                $this->tanggal_terbit->addErrorMessage(str_replace("%s", $this->tanggal_terbit->caption(), $this->tanggal_terbit->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tanggal_terbit->FormValue, $this->tanggal_terbit->formatPattern())) {
            $this->tanggal_terbit->addErrorMessage($this->tanggal_terbit->getErrorMessage(false));
        }
        if ($this->excerpts->Visible && $this->excerpts->Required) {
            if (!$this->excerpts->IsDetailKey && EmptyValue($this->excerpts->FormValue)) {
                $this->excerpts->addErrorMessage(str_replace("%s", $this->excerpts->caption(), $this->excerpts->RequiredErrorMessage));
            }
        }
        if ($this->slug->Visible && $this->slug->Required) {
            if (!$this->slug->IsDetailKey && EmptyValue($this->slug->FormValue)) {
                $this->slug->addErrorMessage(str_replace("%s", $this->slug->caption(), $this->slug->RequiredErrorMessage));
            }
        }
        if ($this->author->Visible && $this->author->Required) {
            if (!$this->author->IsDetailKey && EmptyValue($this->author->FormValue)) {
                $this->author->addErrorMessage(str_replace("%s", $this->author->caption(), $this->author->RequiredErrorMessage));
            }
        }
        if ($this->isi_berita->Visible && $this->isi_berita->Required) {
            if (!$this->isi_berita->IsDetailKey && EmptyValue($this->isi_berita->FormValue)) {
                $this->isi_berita->addErrorMessage(str_replace("%s", $this->isi_berita->caption(), $this->isi_berita->RequiredErrorMessage));
            }
        }
        if ($this->gbr_berita->Visible && $this->gbr_berita->Required) {
            if ($this->gbr_berita->Upload->FileName == "" && !$this->gbr_berita->Upload->KeepFile) {
                $this->gbr_berita->addErrorMessage(str_replace("%s", $this->gbr_berita->caption(), $this->gbr_berita->RequiredErrorMessage));
            }
        }
        if ($this->headline->Visible && $this->headline->Required) {
            if ($this->headline->FormValue == "") {
                $this->headline->addErrorMessage(str_replace("%s", $this->headline->caption(), $this->headline->RequiredErrorMessage));
            }
        }
        if ($this->created_at->Visible && $this->created_at->Required) {
            if (!$this->created_at->IsDetailKey && EmptyValue($this->created_at->FormValue)) {
                $this->created_at->addErrorMessage(str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
            }
        }
        if ($this->updated_at->Visible && $this->updated_at->Required) {
            if (!$this->updated_at->IsDetailKey && EmptyValue($this->updated_at->FormValue)) {
                $this->updated_at->addErrorMessage(str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
            }
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set new row
        $rsnew = [];

        // judul
        $this->judul->setDbValueDef($rsnew, $this->judul->CurrentValue, false);

        // kategori_berita_id
        $this->kategori_berita_id->setDbValueDef($rsnew, $this->kategori_berita_id->CurrentValue, false);

        // tanggal_terbit
        $this->tanggal_terbit->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal_terbit->CurrentValue, $this->tanggal_terbit->formatPattern()), false);

        // excerpts
        $this->excerpts->setDbValueDef($rsnew, $this->excerpts->CurrentValue, false);

        // slug
        $this->slug->setDbValueDef($rsnew, $this->slug->CurrentValue, false);

        // author
        $this->author->setDbValueDef($rsnew, $this->author->CurrentValue, false);

        // isi_berita
        $this->isi_berita->setDbValueDef($rsnew, $this->isi_berita->CurrentValue, false);

        // gbr_berita
        if ($this->gbr_berita->Visible && !$this->gbr_berita->Upload->KeepFile) {
            $this->gbr_berita->Upload->DbValue = ""; // No need to delete old file
            if ($this->gbr_berita->Upload->FileName == "") {
                $rsnew['gbr_berita'] = null;
            } else {
                $rsnew['gbr_berita'] = $this->gbr_berita->Upload->FileName;
            }
        }

        // headline
        $this->headline->setDbValueDef($rsnew, strval($this->headline->CurrentValue) == "1" ? "1" : "0", false);

        // created_at
        $this->created_at->CurrentValue = $this->created_at->getAutoUpdateValue(); // PHP
        $this->created_at->setDbValueDef($rsnew, $this->created_at->CurrentValue);

        // updated_at
        $this->updated_at->CurrentValue = $this->updated_at->getAutoUpdateValue(); // PHP
        $this->updated_at->setDbValueDef($rsnew, $this->updated_at->CurrentValue);
        if ($this->gbr_berita->Visible && !$this->gbr_berita->Upload->KeepFile) {
            $this->gbr_berita->UploadPath = $this->gbr_berita->getUploadPath(); // PHP
            $oldFiles = EmptyValue($this->gbr_berita->Upload->DbValue) ? [] : [$this->gbr_berita->htmlDecode($this->gbr_berita->Upload->DbValue)];
            if (!EmptyValue($this->gbr_berita->Upload->FileName)) {
                $newFiles = [$this->gbr_berita->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->gbr_berita, $this->gbr_berita->Upload->Index);
                        if (file_exists($tempPath . $file)) {
                            if (Config("DELETE_UPLOADED_FILES")) {
                                $oldFileFound = false;
                                $oldFileCount = count($oldFiles);
                                for ($j = 0; $j < $oldFileCount; $j++) {
                                    $oldFile = $oldFiles[$j];
                                    if ($oldFile == $file) { // Old file found, no need to delete anymore
                                        array_splice($oldFiles, $j, 1);
                                        $oldFileFound = true;
                                        break;
                                    }
                                }
                                if ($oldFileFound) { // No need to check if file exists further
                                    continue;
                                }
                            }
                            $file1 = UniqueFilename($this->gbr_berita->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->gbr_berita->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->gbr_berita->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->gbr_berita->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->gbr_berita->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->gbr_berita->setDbValueDef($rsnew, $this->gbr_berita->Upload->FileName, false);
            }
        }

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);
        $this->gbr_berita->OldUploadPath = $this->gbr_berita->getUploadPath(); // PHP
        $this->gbr_berita->UploadPath = $this->gbr_berita->OldUploadPath;

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
                if ($this->gbr_berita->Visible && !$this->gbr_berita->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->gbr_berita->Upload->DbValue) ? [] : [$this->gbr_berita->htmlDecode($this->gbr_berita->Upload->DbValue)];
                    if (!EmptyValue($this->gbr_berita->Upload->FileName)) {
                        $newFiles = [$this->gbr_berita->Upload->FileName];
                        $newFiles2 = [$this->gbr_berita->htmlDecode($rsnew['gbr_berita'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->gbr_berita, $this->gbr_berita->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->gbr_berita->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
                                        $this->setFailureMessage($Language->phrase("UploadError7"));
                                        return false;
                                    }
                                }
                            }
                        }
                    } else {
                        $newFiles = [];
                    }
                }
            } elseif (!EmptyValue($this->DbErrorMessage)) { // Show database error
                $this->setFailureMessage($this->DbErrorMessage);
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_ADD_ACTION"), $table => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("BeritasList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
                case "x_kategori_berita_id":
                    break;
                case "x_headline":
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
