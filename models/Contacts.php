<?php

namespace PHPMaker2023\crudperumdautama;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for contacts
 */
class Contacts extends DbTable
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
    public $company_id;
    public $type;
    public $name;
    public $_email;
    public $user_id;
    public $tax_number;
    public $phone;
    public $address;
    public $city;
    public $zip_code;
    public $state;
    public $country;
    public $website;
    public $currency_code;
    public $enabled;
    public $reference;
    public $created_from;
    public $created_by;
    public $created_at;
    public $updated_at;
    public $deleted_at;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("language");
        $this->TableVar = "contacts";
        $this->TableName = 'contacts';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "contacts";
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
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
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
            3, // Type
            11, // Size
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
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['id'] = &$this->id;

        // company_id
        $this->company_id = new DbField(
            $this, // Table
            'x_company_id', // Variable name
            'company_id', // Name
            '`company_id`', // Expression
            '`company_id`', // Basic search expression
            20, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`company_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->company_id->InputTextType = "text";
        $this->company_id->Nullable = false; // NOT NULL field
        $this->company_id->Required = true; // Required field
        $this->company_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->company_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['company_id'] = &$this->company_id;

        // type
        $this->type = new DbField(
            $this, // Table
            'x_type', // Variable name
            'type', // Name
            '`type`', // Expression
            '`type`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`type`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->type->InputTextType = "text";
        $this->type->Nullable = false; // NOT NULL field
        $this->type->Required = true; // Required field
        $this->type->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['type'] = &$this->type;

        // name
        $this->name = new DbField(
            $this, // Table
            'x_name', // Variable name
            'name', // Name
            '`name`', // Expression
            '`name`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->name->InputTextType = "text";
        $this->name->Nullable = false; // NOT NULL field
        $this->name->Required = true; // Required field
        $this->name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['name'] = &$this->name;

        // email
        $this->_email = new DbField(
            $this, // Table
            'x__email', // Variable name
            'email', // Name
            '`email`', // Expression
            '`email`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`email`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->_email->InputTextType = "text";
        $this->_email->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['email'] = &$this->_email;

        // user_id
        $this->user_id = new DbField(
            $this, // Table
            'x_user_id', // Variable name
            'user_id', // Name
            '`user_id`', // Expression
            '`user_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`user_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->user_id->InputTextType = "text";
        $this->user_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->user_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['user_id'] = &$this->user_id;

        // tax_number
        $this->tax_number = new DbField(
            $this, // Table
            'x_tax_number', // Variable name
            'tax_number', // Name
            '`tax_number`', // Expression
            '`tax_number`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`tax_number`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->tax_number->InputTextType = "text";
        $this->tax_number->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['tax_number'] = &$this->tax_number;

        // phone
        $this->phone = new DbField(
            $this, // Table
            'x_phone', // Variable name
            'phone', // Name
            '`phone`', // Expression
            '`phone`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`phone`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->phone->InputTextType = "text";
        $this->phone->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['phone'] = &$this->phone;

        // address
        $this->address = new DbField(
            $this, // Table
            'x_address', // Variable name
            'address', // Name
            '`address`', // Expression
            '`address`', // Basic search expression
            201, // Type
            65535, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`address`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->address->InputTextType = "text";
        $this->address->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['address'] = &$this->address;

        // city
        $this->city = new DbField(
            $this, // Table
            'x_city', // Variable name
            'city', // Name
            '`city`', // Expression
            '`city`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`city`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->city->InputTextType = "text";
        $this->city->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['city'] = &$this->city;

        // zip_code
        $this->zip_code = new DbField(
            $this, // Table
            'x_zip_code', // Variable name
            'zip_code', // Name
            '`zip_code`', // Expression
            '`zip_code`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`zip_code`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->zip_code->InputTextType = "text";
        $this->zip_code->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['zip_code'] = &$this->zip_code;

        // state
        $this->state = new DbField(
            $this, // Table
            'x_state', // Variable name
            'state', // Name
            '`state`', // Expression
            '`state`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`state`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->state->InputTextType = "text";
        $this->state->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['state'] = &$this->state;

        // country
        $this->country = new DbField(
            $this, // Table
            'x_country', // Variable name
            'country', // Name
            '`country`', // Expression
            '`country`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`country`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->country->InputTextType = "text";
        $this->country->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['country'] = &$this->country;

        // website
        $this->website = new DbField(
            $this, // Table
            'x_website', // Variable name
            'website', // Name
            '`website`', // Expression
            '`website`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`website`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->website->InputTextType = "text";
        $this->website->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['website'] = &$this->website;

        // currency_code
        $this->currency_code = new DbField(
            $this, // Table
            'x_currency_code', // Variable name
            'currency_code', // Name
            '`currency_code`', // Expression
            '`currency_code`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`currency_code`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->currency_code->InputTextType = "text";
        $this->currency_code->Nullable = false; // NOT NULL field
        $this->currency_code->Required = true; // Required field
        $this->currency_code->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['currency_code'] = &$this->currency_code;

        // enabled
        $this->enabled = new DbField(
            $this, // Table
            'x_enabled', // Variable name
            'enabled', // Name
            '`enabled`', // Expression
            '`enabled`', // Basic search expression
            16, // Type
            1, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`enabled`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'CHECKBOX' // Edit Tag
        );
        $this->enabled->addMethod("getDefault", fn() => 1);
        $this->enabled->InputTextType = "text";
        $this->enabled->DataType = DATATYPE_BOOLEAN;
        $this->enabled->Lookup = new Lookup('enabled', 'contacts', false, '', ["","","",""], '', '', [], [], [], [], [], [], '', '', "");
        $this->enabled->OptionCount = 2;
        $this->enabled->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->enabled->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['enabled'] = &$this->enabled;

        // reference
        $this->reference = new DbField(
            $this, // Table
            'x_reference', // Variable name
            'reference', // Name
            '`reference`', // Expression
            '`reference`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`reference`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->reference->InputTextType = "text";
        $this->reference->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['reference'] = &$this->reference;

        // created_from
        $this->created_from = new DbField(
            $this, // Table
            'x_created_from', // Variable name
            'created_from', // Name
            '`created_from`', // Expression
            '`created_from`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`created_from`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->created_from->InputTextType = "text";
        $this->created_from->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['created_from'] = &$this->created_from;

        // created_by
        $this->created_by = new DbField(
            $this, // Table
            'x_created_by', // Variable name
            'created_by', // Name
            '`created_by`', // Expression
            '`created_by`', // Basic search expression
            19, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`created_by`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->created_by->InputTextType = "text";
        $this->created_by->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->created_by->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['created_by'] = &$this->created_by;

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
        $this->created_at->addMethod("getAutoUpdateValue", fn() => CurrentDateTime());
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
        $this->updated_at->addMethod("getAutoUpdateValue", fn() => CurrentDateTime());
        $this->updated_at->InputTextType = "text";
        $this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->updated_at->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['updated_at'] = &$this->updated_at;

        // deleted_at
        $this->deleted_at = new DbField(
            $this, // Table
            'x_deleted_at', // Variable name
            'deleted_at', // Name
            '`deleted_at`', // Expression
            CastDateFieldForLike("`deleted_at`", 0, "DB"), // Basic search expression
            135, // Type
            19, // Size
            0, // Date/Time format
            false, // Is upload field
            '`deleted_at`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->deleted_at->addMethod("getAutoUpdateValue", fn() => CurrentDateTime());
        $this->deleted_at->InputTextType = "text";
        $this->deleted_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->deleted_at->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['deleted_at'] = &$this->deleted_at;

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

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "contacts";
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
        $this->company_id->DbValue = $row['company_id'];
        $this->type->DbValue = $row['type'];
        $this->name->DbValue = $row['name'];
        $this->_email->DbValue = $row['email'];
        $this->user_id->DbValue = $row['user_id'];
        $this->tax_number->DbValue = $row['tax_number'];
        $this->phone->DbValue = $row['phone'];
        $this->address->DbValue = $row['address'];
        $this->city->DbValue = $row['city'];
        $this->zip_code->DbValue = $row['zip_code'];
        $this->state->DbValue = $row['state'];
        $this->country->DbValue = $row['country'];
        $this->website->DbValue = $row['website'];
        $this->currency_code->DbValue = $row['currency_code'];
        $this->enabled->DbValue = $row['enabled'];
        $this->reference->DbValue = $row['reference'];
        $this->created_from->DbValue = $row['created_from'];
        $this->created_by->DbValue = $row['created_by'];
        $this->created_at->DbValue = $row['created_at'];
        $this->updated_at->DbValue = $row['updated_at'];
        $this->deleted_at->DbValue = $row['deleted_at'];
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
        return $_SESSION[$name] ?? GetUrl("ContactsList");
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
        if ($pageName == "ContactsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ContactsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ContactsAdd") {
            return $Language->phrase("Add");
        }
        return "";
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "ContactsView";
            case Config("API_ADD_ACTION"):
                return "ContactsAdd";
            case Config("API_EDIT_ACTION"):
                return "ContactsEdit";
            case Config("API_DELETE_ACTION"):
                return "ContactsDelete";
            case Config("API_LIST_ACTION"):
                return "ContactsList";
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
        return "ContactsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ContactsView", $parm);
        } else {
            $url = $this->keyUrl("ContactsView", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ContactsAdd?" . $parm;
        } else {
            $url = "ContactsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ContactsEdit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("ContactsList", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("ContactsAdd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("ContactsList", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("ContactsDelete");
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
        $this->company_id->setDbValue($row['company_id']);
        $this->type->setDbValue($row['type']);
        $this->name->setDbValue($row['name']);
        $this->_email->setDbValue($row['email']);
        $this->user_id->setDbValue($row['user_id']);
        $this->tax_number->setDbValue($row['tax_number']);
        $this->phone->setDbValue($row['phone']);
        $this->address->setDbValue($row['address']);
        $this->city->setDbValue($row['city']);
        $this->zip_code->setDbValue($row['zip_code']);
        $this->state->setDbValue($row['state']);
        $this->country->setDbValue($row['country']);
        $this->website->setDbValue($row['website']);
        $this->currency_code->setDbValue($row['currency_code']);
        $this->enabled->setDbValue($row['enabled']);
        $this->reference->setDbValue($row['reference']);
        $this->created_from->setDbValue($row['created_from']);
        $this->created_by->setDbValue($row['created_by']);
        $this->created_at->setDbValue($row['created_at']);
        $this->updated_at->setDbValue($row['updated_at']);
        $this->deleted_at->setDbValue($row['deleted_at']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "ContactsList";
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

        // company_id

        // type

        // name

        // email

        // user_id

        // tax_number

        // phone

        // address

        // city

        // zip_code

        // state

        // country

        // website

        // currency_code

        // enabled

        // reference

        // created_from

        // created_by

        // created_at

        // updated_at

        // deleted_at

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewValue = FormatNumber($this->id->ViewValue, $this->id->formatPattern());

        // company_id
        $this->company_id->ViewValue = $this->company_id->CurrentValue;
        $this->company_id->ViewValue = FormatNumber($this->company_id->ViewValue, $this->company_id->formatPattern());

        // type
        $this->type->ViewValue = $this->type->CurrentValue;

        // name
        $this->name->ViewValue = $this->name->CurrentValue;

        // email
        $this->_email->ViewValue = $this->_email->CurrentValue;

        // user_id
        $this->user_id->ViewValue = $this->user_id->CurrentValue;
        $this->user_id->ViewValue = FormatNumber($this->user_id->ViewValue, $this->user_id->formatPattern());

        // tax_number
        $this->tax_number->ViewValue = $this->tax_number->CurrentValue;

        // phone
        $this->phone->ViewValue = $this->phone->CurrentValue;

        // address
        $this->address->ViewValue = $this->address->CurrentValue;

        // city
        $this->city->ViewValue = $this->city->CurrentValue;

        // zip_code
        $this->zip_code->ViewValue = $this->zip_code->CurrentValue;

        // state
        $this->state->ViewValue = $this->state->CurrentValue;

        // country
        $this->country->ViewValue = $this->country->CurrentValue;

        // website
        $this->website->ViewValue = $this->website->CurrentValue;

        // currency_code
        $this->currency_code->ViewValue = $this->currency_code->CurrentValue;

        // enabled
        if (ConvertToBool($this->enabled->CurrentValue)) {
            $this->enabled->ViewValue = $this->enabled->tagCaption(1) != "" ? $this->enabled->tagCaption(1) : "Yes";
        } else {
            $this->enabled->ViewValue = $this->enabled->tagCaption(2) != "" ? $this->enabled->tagCaption(2) : "No";
        }

        // reference
        $this->reference->ViewValue = $this->reference->CurrentValue;

        // created_from
        $this->created_from->ViewValue = $this->created_from->CurrentValue;

        // created_by
        $this->created_by->ViewValue = $this->created_by->CurrentValue;
        $this->created_by->ViewValue = FormatNumber($this->created_by->ViewValue, $this->created_by->formatPattern());

        // created_at
        $this->created_at->ViewValue = $this->created_at->CurrentValue;
        $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, $this->created_at->formatPattern());

        // updated_at
        $this->updated_at->ViewValue = $this->updated_at->CurrentValue;
        $this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, $this->updated_at->formatPattern());

        // deleted_at
        $this->deleted_at->ViewValue = $this->deleted_at->CurrentValue;
        $this->deleted_at->ViewValue = FormatDateTime($this->deleted_at->ViewValue, $this->deleted_at->formatPattern());

        // id
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // company_id
        $this->company_id->HrefValue = "";
        $this->company_id->TooltipValue = "";

        // type
        $this->type->HrefValue = "";
        $this->type->TooltipValue = "";

        // name
        $this->name->HrefValue = "";
        $this->name->TooltipValue = "";

        // email
        $this->_email->HrefValue = "";
        $this->_email->TooltipValue = "";

        // user_id
        $this->user_id->HrefValue = "";
        $this->user_id->TooltipValue = "";

        // tax_number
        $this->tax_number->HrefValue = "";
        $this->tax_number->TooltipValue = "";

        // phone
        $this->phone->HrefValue = "";
        $this->phone->TooltipValue = "";

        // address
        $this->address->HrefValue = "";
        $this->address->TooltipValue = "";

        // city
        $this->city->HrefValue = "";
        $this->city->TooltipValue = "";

        // zip_code
        $this->zip_code->HrefValue = "";
        $this->zip_code->TooltipValue = "";

        // state
        $this->state->HrefValue = "";
        $this->state->TooltipValue = "";

        // country
        $this->country->HrefValue = "";
        $this->country->TooltipValue = "";

        // website
        $this->website->HrefValue = "";
        $this->website->TooltipValue = "";

        // currency_code
        $this->currency_code->HrefValue = "";
        $this->currency_code->TooltipValue = "";

        // enabled
        $this->enabled->HrefValue = "";
        $this->enabled->TooltipValue = "";

        // reference
        $this->reference->HrefValue = "";
        $this->reference->TooltipValue = "";

        // created_from
        $this->created_from->HrefValue = "";
        $this->created_from->TooltipValue = "";

        // created_by
        $this->created_by->HrefValue = "";
        $this->created_by->TooltipValue = "";

        // created_at
        $this->created_at->HrefValue = "";
        $this->created_at->TooltipValue = "";

        // updated_at
        $this->updated_at->HrefValue = "";
        $this->updated_at->TooltipValue = "";

        // deleted_at
        $this->deleted_at->HrefValue = "";
        $this->deleted_at->TooltipValue = "";

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
        $this->id->EditValue = FormatNumber($this->id->EditValue, $this->id->formatPattern());

        // company_id
        $this->company_id->setupEditAttributes();
        $this->company_id->EditValue = $this->company_id->CurrentValue;
        $this->company_id->PlaceHolder = RemoveHtml($this->company_id->caption());
        if (strval($this->company_id->EditValue) != "" && is_numeric($this->company_id->EditValue)) {
            $this->company_id->EditValue = FormatNumber($this->company_id->EditValue, null);
        }

        // type
        $this->type->setupEditAttributes();
        if (!$this->type->Raw) {
            $this->type->CurrentValue = HtmlDecode($this->type->CurrentValue);
        }
        $this->type->EditValue = $this->type->CurrentValue;
        $this->type->PlaceHolder = RemoveHtml($this->type->caption());

        // name
        $this->name->setupEditAttributes();
        if (!$this->name->Raw) {
            $this->name->CurrentValue = HtmlDecode($this->name->CurrentValue);
        }
        $this->name->EditValue = $this->name->CurrentValue;
        $this->name->PlaceHolder = RemoveHtml($this->name->caption());

        // email
        $this->_email->setupEditAttributes();
        if (!$this->_email->Raw) {
            $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
        }
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // user_id
        $this->user_id->setupEditAttributes();
        $this->user_id->EditValue = $this->user_id->CurrentValue;
        $this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());
        if (strval($this->user_id->EditValue) != "" && is_numeric($this->user_id->EditValue)) {
            $this->user_id->EditValue = FormatNumber($this->user_id->EditValue, null);
        }

        // tax_number
        $this->tax_number->setupEditAttributes();
        if (!$this->tax_number->Raw) {
            $this->tax_number->CurrentValue = HtmlDecode($this->tax_number->CurrentValue);
        }
        $this->tax_number->EditValue = $this->tax_number->CurrentValue;
        $this->tax_number->PlaceHolder = RemoveHtml($this->tax_number->caption());

        // phone
        $this->phone->setupEditAttributes();
        if (!$this->phone->Raw) {
            $this->phone->CurrentValue = HtmlDecode($this->phone->CurrentValue);
        }
        $this->phone->EditValue = $this->phone->CurrentValue;
        $this->phone->PlaceHolder = RemoveHtml($this->phone->caption());

        // address
        $this->address->setupEditAttributes();
        $this->address->EditValue = $this->address->CurrentValue;
        $this->address->PlaceHolder = RemoveHtml($this->address->caption());

        // city
        $this->city->setupEditAttributes();
        if (!$this->city->Raw) {
            $this->city->CurrentValue = HtmlDecode($this->city->CurrentValue);
        }
        $this->city->EditValue = $this->city->CurrentValue;
        $this->city->PlaceHolder = RemoveHtml($this->city->caption());

        // zip_code
        $this->zip_code->setupEditAttributes();
        if (!$this->zip_code->Raw) {
            $this->zip_code->CurrentValue = HtmlDecode($this->zip_code->CurrentValue);
        }
        $this->zip_code->EditValue = $this->zip_code->CurrentValue;
        $this->zip_code->PlaceHolder = RemoveHtml($this->zip_code->caption());

        // state
        $this->state->setupEditAttributes();
        if (!$this->state->Raw) {
            $this->state->CurrentValue = HtmlDecode($this->state->CurrentValue);
        }
        $this->state->EditValue = $this->state->CurrentValue;
        $this->state->PlaceHolder = RemoveHtml($this->state->caption());

        // country
        $this->country->setupEditAttributes();
        if (!$this->country->Raw) {
            $this->country->CurrentValue = HtmlDecode($this->country->CurrentValue);
        }
        $this->country->EditValue = $this->country->CurrentValue;
        $this->country->PlaceHolder = RemoveHtml($this->country->caption());

        // website
        $this->website->setupEditAttributes();
        if (!$this->website->Raw) {
            $this->website->CurrentValue = HtmlDecode($this->website->CurrentValue);
        }
        $this->website->EditValue = $this->website->CurrentValue;
        $this->website->PlaceHolder = RemoveHtml($this->website->caption());

        // currency_code
        $this->currency_code->setupEditAttributes();
        if (!$this->currency_code->Raw) {
            $this->currency_code->CurrentValue = HtmlDecode($this->currency_code->CurrentValue);
        }
        $this->currency_code->EditValue = $this->currency_code->CurrentValue;
        $this->currency_code->PlaceHolder = RemoveHtml($this->currency_code->caption());

        // enabled
        $this->enabled->EditValue = $this->enabled->options(false);
        $this->enabled->PlaceHolder = RemoveHtml($this->enabled->caption());

        // reference
        $this->reference->setupEditAttributes();
        if (!$this->reference->Raw) {
            $this->reference->CurrentValue = HtmlDecode($this->reference->CurrentValue);
        }
        $this->reference->EditValue = $this->reference->CurrentValue;
        $this->reference->PlaceHolder = RemoveHtml($this->reference->caption());

        // created_from
        $this->created_from->setupEditAttributes();
        if (!$this->created_from->Raw) {
            $this->created_from->CurrentValue = HtmlDecode($this->created_from->CurrentValue);
        }
        $this->created_from->EditValue = $this->created_from->CurrentValue;
        $this->created_from->PlaceHolder = RemoveHtml($this->created_from->caption());

        // created_by
        $this->created_by->setupEditAttributes();
        $this->created_by->EditValue = $this->created_by->CurrentValue;
        $this->created_by->PlaceHolder = RemoveHtml($this->created_by->caption());
        if (strval($this->created_by->EditValue) != "" && is_numeric($this->created_by->EditValue)) {
            $this->created_by->EditValue = FormatNumber($this->created_by->EditValue, null);
        }

        // created_at

        // updated_at

        // deleted_at

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
                    $doc->exportCaption($this->company_id);
                    $doc->exportCaption($this->type);
                    $doc->exportCaption($this->name);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->user_id);
                    $doc->exportCaption($this->tax_number);
                    $doc->exportCaption($this->phone);
                    $doc->exportCaption($this->address);
                    $doc->exportCaption($this->city);
                    $doc->exportCaption($this->zip_code);
                    $doc->exportCaption($this->state);
                    $doc->exportCaption($this->country);
                    $doc->exportCaption($this->website);
                    $doc->exportCaption($this->currency_code);
                    $doc->exportCaption($this->enabled);
                    $doc->exportCaption($this->reference);
                    $doc->exportCaption($this->created_from);
                    $doc->exportCaption($this->created_by);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->deleted_at);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->company_id);
                    $doc->exportCaption($this->type);
                    $doc->exportCaption($this->name);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->user_id);
                    $doc->exportCaption($this->tax_number);
                    $doc->exportCaption($this->phone);
                    $doc->exportCaption($this->city);
                    $doc->exportCaption($this->zip_code);
                    $doc->exportCaption($this->state);
                    $doc->exportCaption($this->country);
                    $doc->exportCaption($this->website);
                    $doc->exportCaption($this->currency_code);
                    $doc->exportCaption($this->enabled);
                    $doc->exportCaption($this->reference);
                    $doc->exportCaption($this->created_from);
                    $doc->exportCaption($this->created_by);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->deleted_at);
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
                        $doc->exportField($this->company_id);
                        $doc->exportField($this->type);
                        $doc->exportField($this->name);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->user_id);
                        $doc->exportField($this->tax_number);
                        $doc->exportField($this->phone);
                        $doc->exportField($this->address);
                        $doc->exportField($this->city);
                        $doc->exportField($this->zip_code);
                        $doc->exportField($this->state);
                        $doc->exportField($this->country);
                        $doc->exportField($this->website);
                        $doc->exportField($this->currency_code);
                        $doc->exportField($this->enabled);
                        $doc->exportField($this->reference);
                        $doc->exportField($this->created_from);
                        $doc->exportField($this->created_by);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->deleted_at);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->company_id);
                        $doc->exportField($this->type);
                        $doc->exportField($this->name);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->user_id);
                        $doc->exportField($this->tax_number);
                        $doc->exportField($this->phone);
                        $doc->exportField($this->city);
                        $doc->exportField($this->zip_code);
                        $doc->exportField($this->state);
                        $doc->exportField($this->country);
                        $doc->exportField($this->website);
                        $doc->exportField($this->currency_code);
                        $doc->exportField($this->enabled);
                        $doc->exportField($this->reference);
                        $doc->exportField($this->created_from);
                        $doc->exportField($this->created_by);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->deleted_at);
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
        // Enter your code here
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
