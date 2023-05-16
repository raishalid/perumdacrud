<?php

namespace PHPMaker2023\crudperumdautama;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for projects
 */
class Projects extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $DbErrorMessage = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Ajax / Modal
    public $UseAjaxActions = false;
    public $ModalSearch = false;
    public $ModalView = false;
    public $ModalAdd = false;
    public $ModalEdit = false;
    public $ModalUpdate = false;
    public $InlineDelete = false;
    public $ModalGridAdd = false;
    public $ModalGridEdit = false;
    public $ModalMultiEdit = false;

    // Fields
    public $id;
    public $project_category_id;
    public $project_provider_id;
    public $project_status_id;
    public $funding_source_id;
    public $project_name;
    public $project_description;
    public $project_budget;
    public $project_target;
    public $project_start;
    public $project_duration;
    public $project_html;
    public $project_headgbr;
    public $slug;
    public $created_at;
    public $updated_at;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("language");
        $this->TableVar = "projects";
        $this->TableName = 'projects';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "projects";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)

        // PDF
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)

        // PhpSpreadsheet
        $this->ExportExcelPageOrientation = null; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = null; // Page size (PhpSpreadsheet only)

        // PHPWord
        $this->ExportWordPageOrientation = ""; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = ""; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = true; // Allow detail add
        $this->DetailEdit = true; // Allow detail edit
        $this->DetailView = true; // Allow detail view
        $this->ShowMultipleDetails = true; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UseAjaxActions = $this->UseAjaxActions || Config("USE_AJAX_ACTIONS");
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this);

        // id
        $this->id = new DbField(
            $this, // Table
            'x_id', // Variable name
            'id', // Name
            '`id`', // Expression
            '`id`', // Basic search expression
            21, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'NO' // Edit Tag
        );
        $this->id->InputTextType = "text";
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->IsForeignKey = true; // Foreign key field
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['id'] = &$this->id;

        // project_category_id
        $this->project_category_id = new DbField(
            $this, // Table
            'x_project_category_id', // Variable name
            'project_category_id', // Name
            '`project_category_id`', // Expression
            '`project_category_id`', // Basic search expression
            21, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`project_category_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->project_category_id->InputTextType = "text";
        $this->project_category_id->Nullable = false; // NOT NULL field
        $this->project_category_id->Required = true; // Required field
        $this->project_category_id->setSelectMultiple(false); // Select one
        $this->project_category_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->project_category_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->project_category_id->Lookup = new Lookup('project_category_id', 'project_categories', false, 'id', ["category_name","","",""], '', '', [], [], [], [], [], [], '', '', "`category_name`");
        $this->project_category_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->project_category_id->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['project_category_id'] = &$this->project_category_id;

        // project_provider_id
        $this->project_provider_id = new DbField(
            $this, // Table
            'x_project_provider_id', // Variable name
            'project_provider_id', // Name
            '`project_provider_id`', // Expression
            '`project_provider_id`', // Basic search expression
            21, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`project_provider_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->project_provider_id->InputTextType = "text";
        $this->project_provider_id->Nullable = false; // NOT NULL field
        $this->project_provider_id->Required = true; // Required field
        $this->project_provider_id->setSelectMultiple(false); // Select one
        $this->project_provider_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->project_provider_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->project_provider_id->Lookup = new Lookup('project_provider_id', 'project_providers', false, 'id', ["provider_name","","",""], '', '', [], [], [], [], [], [], '', '', "`provider_name`");
        $this->project_provider_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->project_provider_id->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['project_provider_id'] = &$this->project_provider_id;

        // project_status_id
        $this->project_status_id = new DbField(
            $this, // Table
            'x_project_status_id', // Variable name
            'project_status_id', // Name
            '`project_status_id`', // Expression
            '`project_status_id`', // Basic search expression
            21, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`project_status_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->project_status_id->InputTextType = "text";
        $this->project_status_id->Nullable = false; // NOT NULL field
        $this->project_status_id->Required = true; // Required field
        $this->project_status_id->setSelectMultiple(false); // Select one
        $this->project_status_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->project_status_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->project_status_id->Lookup = new Lookup('project_status_id', 'project_statuses', false, 'id', ["status_name","","",""], '', '', [], [], [], [], [], [], '', '', "`status_name`");
        $this->project_status_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->project_status_id->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['project_status_id'] = &$this->project_status_id;

        // funding_source_id
        $this->funding_source_id = new DbField(
            $this, // Table
            'x_funding_source_id', // Variable name
            'funding_source_id', // Name
            '`funding_source_id`', // Expression
            '`funding_source_id`', // Basic search expression
            21, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`funding_source_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->funding_source_id->InputTextType = "text";
        $this->funding_source_id->Nullable = false; // NOT NULL field
        $this->funding_source_id->Required = true; // Required field
        $this->funding_source_id->Lookup = new Lookup('funding_source_id', 'funding_sources', false, 'id', ["fundingsource_name","","",""], '', '', [], [], [], [], [], [], '', '', "`fundingsource_name`");
        $this->funding_source_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->funding_source_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['funding_source_id'] = &$this->funding_source_id;

        // project_name
        $this->project_name = new DbField(
            $this, // Table
            'x_project_name', // Variable name
            'project_name', // Name
            '`project_name`', // Expression
            '`project_name`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`project_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->project_name->InputTextType = "text";
        $this->project_name->Nullable = false; // NOT NULL field
        $this->project_name->Required = true; // Required field
        $this->project_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['project_name'] = &$this->project_name;

        // project_description
        $this->project_description = new DbField(
            $this, // Table
            'x_project_description', // Variable name
            'project_description', // Name
            '`project_description`', // Expression
            '`project_description`', // Basic search expression
            201, // Type
            65535, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`project_description`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->project_description->InputTextType = "text";
        $this->project_description->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['project_description'] = &$this->project_description;

        // project_budget
        $this->project_budget = new DbField(
            $this, // Table
            'x_project_budget', // Variable name
            'project_budget', // Name
            '`project_budget`', // Expression
            '`project_budget`', // Basic search expression
            131, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`project_budget`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->project_budget->InputTextType = "text";
        $this->project_budget->Nullable = false; // NOT NULL field
        $this->project_budget->Required = true; // Required field
        $this->project_budget->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->project_budget->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['project_budget'] = &$this->project_budget;

        // project_target
        $this->project_target = new DbField(
            $this, // Table
            'x_project_target', // Variable name
            'project_target', // Name
            '`project_target`', // Expression
            '`project_target`', // Basic search expression
            201, // Type
            65535, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`project_target`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->project_target->InputTextType = "text";
        $this->project_target->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['project_target'] = &$this->project_target;

        // project_start
        $this->project_start = new DbField(
            $this, // Table
            'x_project_start', // Variable name
            'project_start', // Name
            '`project_start`', // Expression
            CastDateFieldForLike("`project_start`", 0, "DB"), // Basic search expression
            135, // Type
            19, // Size
            0, // Date/Time format
            false, // Is upload field
            '`project_start`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->project_start->InputTextType = "text";
        $this->project_start->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->project_start->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['project_start'] = &$this->project_start;

        // project_duration
        $this->project_duration = new DbField(
            $this, // Table
            'x_project_duration', // Variable name
            'project_duration', // Name
            '`project_duration`', // Expression
            '`project_duration`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`project_duration`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->project_duration->InputTextType = "text";
        $this->project_duration->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['project_duration'] = &$this->project_duration;

        // project_html
        $this->project_html = new DbField(
            $this, // Table
            'x_project_html', // Variable name
            'project_html', // Name
            '`project_html`', // Expression
            '`project_html`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`project_html`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->project_html->InputTextType = "text";
        $this->project_html->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['project_html'] = &$this->project_html;

        // project_headgbr
        $this->project_headgbr = new DbField(
            $this, // Table
            'x_project_headgbr', // Variable name
            'project_headgbr', // Name
            '`project_headgbr`', // Expression
            '`project_headgbr`', // Basic search expression
            201, // Type
            65535, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`project_headgbr`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->project_headgbr->InputTextType = "text";
        $this->project_headgbr->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['project_headgbr'] = &$this->project_headgbr;

        // slug
        $this->slug = new DbField(
            $this, // Table
            'x_slug', // Variable name
            'slug', // Name
            '`slug`', // Expression
            '`slug`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`slug`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->slug->InputTextType = "text";
        $this->slug->Nullable = false; // NOT NULL field
        $this->slug->Required = true; // Required field
        $this->slug->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['slug'] = &$this->slug;

        // created_at
        $this->created_at = new DbField(
            $this, // Table
            'x_created_at', // Variable name
            'created_at', // Name
            '`created_at`', // Expression
            CastDateFieldForLike("`created_at`", 0, "DB"), // Basic search expression
            135, // Type
            19, // Size
            0, // Date/Time format
            false, // Is upload field
            '`created_at`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->created_at->InputTextType = "text";
        $this->created_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->created_at->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['created_at'] = &$this->created_at;

        // updated_at
        $this->updated_at = new DbField(
            $this, // Table
            'x_updated_at', // Variable name
            'updated_at', // Name
            '`updated_at`', // Expression
            CastDateFieldForLike("`updated_at`", 0, "DB"), // Basic search expression
            135, // Type
            19, // Size
            0, // Date/Time format
            false, // Is upload field
            '`updated_at`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->updated_at->InputTextType = "text";
        $this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->updated_at->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['updated_at'] = &$this->updated_at;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);

        // Call Table Load event
        $this->tableLoad();
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        }
    }

    // Update field sort
    public function updateFieldSort()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        $flds = GetSortFields($orderBy);
        foreach ($this->Fields as $field) {
            $fldSort = "";
            foreach ($flds as $fld) {
                if ($fld[0] == $field->Expression || $fld[0] == $field->VirtualExpression) {
                    $fldSort = $fld[1];
                }
            }
            $field->setSort($fldSort);
        }
    }

    // Current detail table name
    public function getCurrentDetailTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")) ?? "";
    }

    public function setCurrentDetailTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
    }

    // Get detail url
    public function getDetailUrl()
    {
        // Detail url
        $detailUrl = "";
        if ($this->getCurrentDetailTable() == "project_investors") {
            $detailUrl = Container("project_investors")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "project_files") {
            $detailUrl = Container("project_files")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue);
        }
        if ($detailUrl == "") {
            $detailUrl = "ProjectsList";
        }
        return $detailUrl;
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "projects";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            case "lookup":
                return (($allow & 256) == 256);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlwrk);
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->getSqlAsQueryBuilder($where, $orderBy)->getSQL();
    }

    // Get QueryBuilder
    public function getSqlAsQueryBuilder($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        );
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        try {
            $success = $this->insertSql($rs)->execute();
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }
        if ($success) {
            // Get insert id if necessary
            $this->id->setDbValue($conn->lastInsertId());
            $rs['id'] = $this->id->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        try {
            $success = $this->updateSql($rs, $where, $curfilter)->execute();
            $success = ($success > 0) ? $success : true;
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }

        // Return auto increment field
        if ($success) {
            if (!isset($rs['id']) && !EmptyValue($this->id->CurrentValue)) {
                $rs['id'] = $this->id->CurrentValue;
            }
        }
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('id', $rs)) {
                AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            try {
                $success = $this->deleteSql($rs, $where, $curfilter)->execute();
                $this->DbErrorMessage = "";
            } catch (\Exception $e) {
                $success = false;
                $this->DbErrorMessage = $e->getMessage();
            }
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->id->DbValue = $row['id'];
        $this->project_category_id->DbValue = $row['project_category_id'];
        $this->project_provider_id->DbValue = $row['project_provider_id'];
        $this->project_status_id->DbValue = $row['project_status_id'];
        $this->funding_source_id->DbValue = $row['funding_source_id'];
        $this->project_name->DbValue = $row['project_name'];
        $this->project_description->DbValue = $row['project_description'];
        $this->project_budget->DbValue = $row['project_budget'];
        $this->project_target->DbValue = $row['project_target'];
        $this->project_start->DbValue = $row['project_start'];
        $this->project_duration->DbValue = $row['project_duration'];
        $this->project_html->DbValue = $row['project_html'];
        $this->project_headgbr->DbValue = $row['project_headgbr'];
        $this->slug->DbValue = $row['slug'];
        $this->created_at->DbValue = $row['created_at'];
        $this->updated_at->DbValue = $row['updated_at'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id` = @id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id->CurrentValue : $this->id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id->CurrentValue = $keys[0];
            } else {
                $this->id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id', $row) ? $row['id'] : null;
        } else {
            $val = !EmptyValue($this->id->OldValue) && !$current ? $this->id->OldValue : $this->id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("ProjectsList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "ProjectsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ProjectsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ProjectsAdd") {
            return $Language->phrase("Add");
        }
        return "";
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "ProjectsView";
            case Config("API_ADD_ACTION"):
                return "ProjectsAdd";
            case Config("API_EDIT_ACTION"):
                return "ProjectsEdit";
            case Config("API_DELETE_ACTION"):
                return "ProjectsDelete";
            case Config("API_LIST_ACTION"):
                return "ProjectsList";
            default:
                return "";
        }
    }

    // Current URL
    public function getCurrentUrl($parm = "")
    {
        $url = CurrentPageUrl(false);
        if ($parm != "") {
            $url = $this->keyUrl($url, $parm);
        } else {
            $url = $this->keyUrl($url, Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // List URL
    public function getListUrl()
    {
        return "ProjectsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ProjectsView", $parm);
        } else {
            $url = $this->keyUrl("ProjectsView", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ProjectsAdd?" . $parm;
        } else {
            $url = "ProjectsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ProjectsEdit", $parm);
        } else {
            $url = $this->keyUrl("ProjectsEdit", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("ProjectsList", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ProjectsAdd", $parm);
        } else {
            $url = $this->keyUrl("ProjectsAdd", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("ProjectsList", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("ProjectsDelete");
        }
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"id\":" . JsonEncode($this->id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language, $Page;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-ew-action="sort" data-ajax="' . ($this->UseAjaxActions ? "true" : "false") . '" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
            if ($this->ContextClass) { // Add context
                $attrs .= ' data-context="' . HtmlEncode($this->ContextClass) . '"';
            }
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($fld->UseFilter) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") . '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = "order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort();
            if ($DashboardReport) {
                $urlParm .= "&amp;dashboard=true";
            }
            return $this->addMasterUrl($this->CurrentPageName . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("id") ?? Route("id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from records
    public function getFilterFromRecords($rows)
    {
        $keyFilter = "";
        foreach ($rows as $row) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter($row) . ")";
        }
        return $keyFilter;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->id->CurrentValue = $key;
            } else {
                $this->id->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter / sort
    public function loadRs($filter, $sort = "")
    {
        $sql = $this->getSql($filter, $sort); // Set up filter (WHERE Clause) / sort (ORDER BY Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
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

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "ProjectsList";
        $listClass = PROJECT_NAMESPACE . $listPage;
        $page = new $listClass();
        $page->loadRecordsetFromFilter($filter);
        $view = Container("view");
        $template = $listPage . ".php"; // View
        $GLOBALS["Title"] ??= $page->Title; // Title
        try {
            $Response = $view->render($Response, $template, $GLOBALS);
        } finally {
            $page->terminate(); // Terminate page and clean up
        }
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // project_category_id

        // project_provider_id

        // project_status_id

        // funding_source_id

        // project_name

        // project_description

        // project_budget

        // project_target

        // project_start

        // project_duration

        // project_html

        // project_headgbr

        // slug

        // created_at

        // updated_at

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
        $this->id->TooltipValue = "";

        // project_category_id
        $this->project_category_id->HrefValue = "";
        $this->project_category_id->TooltipValue = "";

        // project_provider_id
        $this->project_provider_id->HrefValue = "";
        $this->project_provider_id->TooltipValue = "";

        // project_status_id
        $this->project_status_id->HrefValue = "";
        $this->project_status_id->TooltipValue = "";

        // funding_source_id
        $this->funding_source_id->HrefValue = "";
        $this->funding_source_id->TooltipValue = "";

        // project_name
        $this->project_name->HrefValue = "";
        $this->project_name->TooltipValue = "";

        // project_description
        $this->project_description->HrefValue = "";
        $this->project_description->TooltipValue = "";

        // project_budget
        $this->project_budget->HrefValue = "";
        $this->project_budget->TooltipValue = "";

        // project_target
        $this->project_target->HrefValue = "";
        $this->project_target->TooltipValue = "";

        // project_start
        $this->project_start->HrefValue = "";
        $this->project_start->TooltipValue = "";

        // project_duration
        $this->project_duration->HrefValue = "";
        $this->project_duration->TooltipValue = "";

        // project_html
        $this->project_html->HrefValue = "";
        $this->project_html->TooltipValue = "";

        // project_headgbr
        $this->project_headgbr->HrefValue = "";
        $this->project_headgbr->TooltipValue = "";

        // slug
        $this->slug->HrefValue = "";
        $this->slug->TooltipValue = "";

        // created_at
        $this->created_at->HrefValue = "";
        $this->created_at->TooltipValue = "";

        // updated_at
        $this->updated_at->HrefValue = "";
        $this->updated_at->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // id
        $this->id->setupEditAttributes();
        $this->id->EditValue = $this->id->CurrentValue;

        // project_category_id
        $this->project_category_id->setupEditAttributes();
        $this->project_category_id->PlaceHolder = RemoveHtml($this->project_category_id->caption());

        // project_provider_id
        $this->project_provider_id->setupEditAttributes();
        $this->project_provider_id->PlaceHolder = RemoveHtml($this->project_provider_id->caption());

        // project_status_id
        $this->project_status_id->setupEditAttributes();
        $this->project_status_id->PlaceHolder = RemoveHtml($this->project_status_id->caption());

        // funding_source_id
        $this->funding_source_id->setupEditAttributes();
        $this->funding_source_id->EditValue = $this->funding_source_id->CurrentValue;
        $this->funding_source_id->PlaceHolder = RemoveHtml($this->funding_source_id->caption());

        // project_name
        $this->project_name->setupEditAttributes();
        if (!$this->project_name->Raw) {
            $this->project_name->CurrentValue = HtmlDecode($this->project_name->CurrentValue);
        }
        $this->project_name->EditValue = $this->project_name->CurrentValue;
        $this->project_name->PlaceHolder = RemoveHtml($this->project_name->caption());

        // project_description
        $this->project_description->setupEditAttributes();
        $this->project_description->EditValue = $this->project_description->CurrentValue;
        $this->project_description->PlaceHolder = RemoveHtml($this->project_description->caption());

        // project_budget
        $this->project_budget->setupEditAttributes();
        $this->project_budget->EditValue = $this->project_budget->CurrentValue;
        $this->project_budget->PlaceHolder = RemoveHtml($this->project_budget->caption());
        if (strval($this->project_budget->EditValue) != "" && is_numeric($this->project_budget->EditValue)) {
            $this->project_budget->EditValue = FormatNumber($this->project_budget->EditValue, null);
        }

        // project_target
        $this->project_target->setupEditAttributes();
        $this->project_target->EditValue = $this->project_target->CurrentValue;
        $this->project_target->PlaceHolder = RemoveHtml($this->project_target->caption());

        // project_start
        $this->project_start->setupEditAttributes();
        $this->project_start->EditValue = FormatDateTime($this->project_start->CurrentValue, $this->project_start->formatPattern());
        $this->project_start->PlaceHolder = RemoveHtml($this->project_start->caption());

        // project_duration
        $this->project_duration->setupEditAttributes();
        if (!$this->project_duration->Raw) {
            $this->project_duration->CurrentValue = HtmlDecode($this->project_duration->CurrentValue);
        }
        $this->project_duration->EditValue = $this->project_duration->CurrentValue;
        $this->project_duration->PlaceHolder = RemoveHtml($this->project_duration->caption());

        // project_html
        $this->project_html->setupEditAttributes();
        $this->project_html->EditValue = $this->project_html->CurrentValue;
        $this->project_html->PlaceHolder = RemoveHtml($this->project_html->caption());

        // project_headgbr
        $this->project_headgbr->setupEditAttributes();
        $this->project_headgbr->EditValue = $this->project_headgbr->CurrentValue;
        $this->project_headgbr->PlaceHolder = RemoveHtml($this->project_headgbr->caption());

        // slug
        $this->slug->setupEditAttributes();
        $this->slug->EditValue = $this->slug->CurrentValue;

        // created_at
        $this->created_at->setupEditAttributes();
        $this->created_at->EditValue = FormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        $this->created_at->PlaceHolder = RemoveHtml($this->created_at->caption());

        // updated_at
        $this->updated_at->setupEditAttributes();
        $this->updated_at->EditValue = FormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
        $this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->project_category_id);
                    $doc->exportCaption($this->project_provider_id);
                    $doc->exportCaption($this->project_status_id);
                    $doc->exportCaption($this->funding_source_id);
                    $doc->exportCaption($this->project_name);
                    $doc->exportCaption($this->project_description);
                    $doc->exportCaption($this->project_budget);
                    $doc->exportCaption($this->project_target);
                    $doc->exportCaption($this->project_start);
                    $doc->exportCaption($this->project_duration);
                    $doc->exportCaption($this->project_html);
                    $doc->exportCaption($this->project_headgbr);
                    $doc->exportCaption($this->slug);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_at);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->project_category_id);
                    $doc->exportCaption($this->project_provider_id);
                    $doc->exportCaption($this->project_status_id);
                    $doc->exportCaption($this->funding_source_id);
                    $doc->exportCaption($this->project_name);
                    $doc->exportCaption($this->project_budget);
                    $doc->exportCaption($this->project_start);
                    $doc->exportCaption($this->project_duration);
                    $doc->exportCaption($this->project_html);
                    $doc->exportCaption($this->slug);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_at);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->id);
                        $doc->exportField($this->project_category_id);
                        $doc->exportField($this->project_provider_id);
                        $doc->exportField($this->project_status_id);
                        $doc->exportField($this->funding_source_id);
                        $doc->exportField($this->project_name);
                        $doc->exportField($this->project_description);
                        $doc->exportField($this->project_budget);
                        $doc->exportField($this->project_target);
                        $doc->exportField($this->project_start);
                        $doc->exportField($this->project_duration);
                        $doc->exportField($this->project_html);
                        $doc->exportField($this->project_headgbr);
                        $doc->exportField($this->slug);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_at);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->project_category_id);
                        $doc->exportField($this->project_provider_id);
                        $doc->exportField($this->project_status_id);
                        $doc->exportField($this->funding_source_id);
                        $doc->exportField($this->project_name);
                        $doc->exportField($this->project_budget);
                        $doc->exportField($this->project_start);
                        $doc->exportField($this->project_duration);
                        $doc->exportField($this->project_html);
                        $doc->exportField($this->slug);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_at);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($doc, $row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;

        // No binary fields
        return false;
    }

    // Table level events
    // Table Load event
    public function tableLoad()
    {
        // // Enter your code here
        // echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProjectFilesModal">Add Files</button>';
        // echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProjectInvestors">Add Investors</button>';
    }

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
