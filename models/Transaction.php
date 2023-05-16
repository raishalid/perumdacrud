<?php

namespace PHPMaker2023\crudperumdautama;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for transaction
 */
class Transaction extends DbTable
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
    public $acc_id;
    public $paid_at;
    public $departement_id;
    public $type_id;
    public $amount;
    public $currency_code;
    public $currency_rate;
    public $document_id;
    public $contact_id;
    public $description;
    public $acc_category_id;
    public $payment_method;
    public $reference;
    public $parent_id;
    public $reconciled;
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
        $this->TableVar = "transaction";
        $this->TableName = 'transaction';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "transaction";
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

        // acc_id
        $this->acc_id = new DbField(
            $this, // Table
            'x_acc_id', // Variable name
            'acc_id', // Name
            '`acc_id`', // Expression
            '`acc_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`acc_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->acc_id->InputTextType = "text";
        $this->acc_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->acc_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['acc_id'] = &$this->acc_id;

        // paid_at
        $this->paid_at = new DbField(
            $this, // Table
            'x_paid_at', // Variable name
            'paid_at', // Name
            '`paid_at`', // Expression
            CastDateFieldForLike("`paid_at`", 0, "DB"), // Basic search expression
            135, // Type
            19, // Size
            0, // Date/Time format
            false, // Is upload field
            '`paid_at`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->paid_at->InputTextType = "text";
        $this->paid_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->paid_at->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['paid_at'] = &$this->paid_at;

        // departement_id
        $this->departement_id = new DbField(
            $this, // Table
            'x_departement_id', // Variable name
            'departement_id', // Name
            '`departement_id`', // Expression
            '`departement_id`', // Basic search expression
            20, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`departement_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->departement_id->InputTextType = "text";
        $this->departement_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->departement_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['departement_id'] = &$this->departement_id;

        // type_id
        $this->type_id = new DbField(
            $this, // Table
            'x_type_id', // Variable name
            'type_id', // Name
            '`type_id`', // Expression
            '`type_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`type_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->type_id->InputTextType = "text";
        $this->type_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->type_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['type_id'] = &$this->type_id;

        // amount
        $this->amount = new DbField(
            $this, // Table
            'x_amount', // Variable name
            'amount', // Name
            '`amount`', // Expression
            '`amount`', // Basic search expression
            5, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`amount`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->amount->InputTextType = "text";
        $this->amount->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->amount->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['amount'] = &$this->amount;

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
        $this->currency_code->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['currency_code'] = &$this->currency_code;

        // currency_rate
        $this->currency_rate = new DbField(
            $this, // Table
            'x_currency_rate', // Variable name
            'currency_rate', // Name
            '`currency_rate`', // Expression
            '`currency_rate`', // Basic search expression
            5, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`currency_rate`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->currency_rate->InputTextType = "text";
        $this->currency_rate->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->currency_rate->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['currency_rate'] = &$this->currency_rate;

        // document_id
        $this->document_id = new DbField(
            $this, // Table
            'x_document_id', // Variable name
            'document_id', // Name
            '`document_id`', // Expression
            '`document_id`', // Basic search expression
            20, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`document_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->document_id->InputTextType = "text";
        $this->document_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->document_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['document_id'] = &$this->document_id;

        // contact_id
        $this->contact_id = new DbField(
            $this, // Table
            'x_contact_id', // Variable name
            'contact_id', // Name
            '`contact_id`', // Expression
            '`contact_id`', // Basic search expression
            20, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`contact_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->contact_id->InputTextType = "text";
        $this->contact_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->contact_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['contact_id'] = &$this->contact_id;

        // description
        $this->description = new DbField(
            $this, // Table
            'x_description', // Variable name
            'description', // Name
            '`description`', // Expression
            '`description`', // Basic search expression
            201, // Type
            65535, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`description`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->description->InputTextType = "text";
        $this->description->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['description'] = &$this->description;

        // acc_category_id
        $this->acc_category_id = new DbField(
            $this, // Table
            'x_acc_category_id', // Variable name
            'acc_category_id', // Name
            '`acc_category_id`', // Expression
            '`acc_category_id`', // Basic search expression
            20, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`acc_category_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->acc_category_id->InputTextType = "text";
        $this->acc_category_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->acc_category_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['acc_category_id'] = &$this->acc_category_id;

        // payment_method
        $this->payment_method = new DbField(
            $this, // Table
            'x_payment_method', // Variable name
            'payment_method', // Name
            '`payment_method`', // Expression
            '`payment_method`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`payment_method`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->payment_method->InputTextType = "text";
        $this->payment_method->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['payment_method'] = &$this->payment_method;

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

        // parent_id
        $this->parent_id = new DbField(
            $this, // Table
            'x_parent_id', // Variable name
            'parent_id', // Name
            '`parent_id`', // Expression
            '`parent_id`', // Basic search expression
            20, // Type
            20, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`parent_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->parent_id->InputTextType = "text";
        $this->parent_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->parent_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['parent_id'] = &$this->parent_id;

        // reconciled
        $this->reconciled = new DbField(
            $this, // Table
            'x_reconciled', // Variable name
            'reconciled', // Name
            '`reconciled`', // Expression
            '`reconciled`', // Basic search expression
            16, // Type
            1, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`reconciled`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'CHECKBOX' // Edit Tag
        );
        $this->reconciled->InputTextType = "text";
        $this->reconciled->DataType = DATATYPE_BOOLEAN;
        $this->reconciled->Lookup = new Lookup('reconciled', 'transaction', false, '', ["","","",""], '', '', [], [], [], [], [], [], '', '', "");
        $this->reconciled->OptionCount = 2;
        $this->reconciled->DefaultErrorMessage = $Language->phrase("IncorrectField");
        $this->reconciled->SearchOperators = ["=", "<>", "IS NULL", "IS NOT NULL"];
        $this->Fields['reconciled'] = &$this->reconciled;

        // created_from
        $this->created_from = new DbField(
            $this, // Table
            'x_created_from', // Variable name
            'created_from', // Name
            '`created_from`', // Expression
            '`created_from`', // Basic search expression
            200, // Type
            255, // Size
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
            200, // Type
            255, // Size
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
        $this->created_by->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "transaction";
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
        $this->acc_id->DbValue = $row['acc_id'];
        $this->paid_at->DbValue = $row['paid_at'];
        $this->departement_id->DbValue = $row['departement_id'];
        $this->type_id->DbValue = $row['type_id'];
        $this->amount->DbValue = $row['amount'];
        $this->currency_code->DbValue = $row['currency_code'];
        $this->currency_rate->DbValue = $row['currency_rate'];
        $this->document_id->DbValue = $row['document_id'];
        $this->contact_id->DbValue = $row['contact_id'];
        $this->description->DbValue = $row['description'];
        $this->acc_category_id->DbValue = $row['acc_category_id'];
        $this->payment_method->DbValue = $row['payment_method'];
        $this->reference->DbValue = $row['reference'];
        $this->parent_id->DbValue = $row['parent_id'];
        $this->reconciled->DbValue = $row['reconciled'];
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
        return $_SESSION[$name] ?? GetUrl("TransactionList");
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
        if ($pageName == "TransactionView") {
            return $Language->phrase("View");
        } elseif ($pageName == "TransactionEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "TransactionAdd") {
            return $Language->phrase("Add");
        }
        return "";
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "TransactionView";
            case Config("API_ADD_ACTION"):
                return "TransactionAdd";
            case Config("API_EDIT_ACTION"):
                return "TransactionEdit";
            case Config("API_DELETE_ACTION"):
                return "TransactionDelete";
            case Config("API_LIST_ACTION"):
                return "TransactionList";
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
        return "TransactionList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("TransactionView", $parm);
        } else {
            $url = $this->keyUrl("TransactionView", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "TransactionAdd?" . $parm;
        } else {
            $url = "TransactionAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("TransactionEdit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("TransactionList", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("TransactionAdd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("TransactionList", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("TransactionDelete");
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
        $this->acc_id->setDbValue($row['acc_id']);
        $this->paid_at->setDbValue($row['paid_at']);
        $this->departement_id->setDbValue($row['departement_id']);
        $this->type_id->setDbValue($row['type_id']);
        $this->amount->setDbValue($row['amount']);
        $this->currency_code->setDbValue($row['currency_code']);
        $this->currency_rate->setDbValue($row['currency_rate']);
        $this->document_id->setDbValue($row['document_id']);
        $this->contact_id->setDbValue($row['contact_id']);
        $this->description->setDbValue($row['description']);
        $this->acc_category_id->setDbValue($row['acc_category_id']);
        $this->payment_method->setDbValue($row['payment_method']);
        $this->reference->setDbValue($row['reference']);
        $this->parent_id->setDbValue($row['parent_id']);
        $this->reconciled->setDbValue($row['reconciled']);
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
        $listPage = "TransactionList";
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

        // acc_id

        // paid_at

        // departement_id

        // type_id

        // amount

        // currency_code

        // currency_rate

        // document_id

        // contact_id

        // description

        // acc_category_id

        // payment_method

        // reference

        // parent_id

        // reconciled

        // created_from

        // created_by

        // created_at

        // updated_at

        // deleted_at

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewValue = FormatNumber($this->id->ViewValue, $this->id->formatPattern());

        // acc_id
        $this->acc_id->ViewValue = $this->acc_id->CurrentValue;
        $this->acc_id->ViewValue = FormatNumber($this->acc_id->ViewValue, $this->acc_id->formatPattern());

        // paid_at
        $this->paid_at->ViewValue = $this->paid_at->CurrentValue;
        $this->paid_at->ViewValue = FormatDateTime($this->paid_at->ViewValue, $this->paid_at->formatPattern());

        // departement_id
        $this->departement_id->ViewValue = $this->departement_id->CurrentValue;
        $this->departement_id->ViewValue = FormatNumber($this->departement_id->ViewValue, $this->departement_id->formatPattern());

        // type_id
        $this->type_id->ViewValue = $this->type_id->CurrentValue;
        $this->type_id->ViewValue = FormatNumber($this->type_id->ViewValue, $this->type_id->formatPattern());

        // amount
        $this->amount->ViewValue = $this->amount->CurrentValue;
        $this->amount->ViewValue = FormatNumber($this->amount->ViewValue, $this->amount->formatPattern());

        // currency_code
        $this->currency_code->ViewValue = $this->currency_code->CurrentValue;

        // currency_rate
        $this->currency_rate->ViewValue = $this->currency_rate->CurrentValue;
        $this->currency_rate->ViewValue = FormatNumber($this->currency_rate->ViewValue, $this->currency_rate->formatPattern());

        // document_id
        $this->document_id->ViewValue = $this->document_id->CurrentValue;
        $this->document_id->ViewValue = FormatNumber($this->document_id->ViewValue, $this->document_id->formatPattern());

        // contact_id
        $this->contact_id->ViewValue = $this->contact_id->CurrentValue;
        $this->contact_id->ViewValue = FormatNumber($this->contact_id->ViewValue, $this->contact_id->formatPattern());

        // description
        $this->description->ViewValue = $this->description->CurrentValue;

        // acc_category_id
        $this->acc_category_id->ViewValue = $this->acc_category_id->CurrentValue;
        $this->acc_category_id->ViewValue = FormatNumber($this->acc_category_id->ViewValue, $this->acc_category_id->formatPattern());

        // payment_method
        $this->payment_method->ViewValue = $this->payment_method->CurrentValue;

        // reference
        $this->reference->ViewValue = $this->reference->CurrentValue;

        // parent_id
        $this->parent_id->ViewValue = $this->parent_id->CurrentValue;
        $this->parent_id->ViewValue = FormatNumber($this->parent_id->ViewValue, $this->parent_id->formatPattern());

        // reconciled
        if (ConvertToBool($this->reconciled->CurrentValue)) {
            $this->reconciled->ViewValue = $this->reconciled->tagCaption(1) != "" ? $this->reconciled->tagCaption(1) : "Yes";
        } else {
            $this->reconciled->ViewValue = $this->reconciled->tagCaption(2) != "" ? $this->reconciled->tagCaption(2) : "No";
        }

        // created_from
        $this->created_from->ViewValue = $this->created_from->CurrentValue;

        // created_by
        $this->created_by->ViewValue = $this->created_by->CurrentValue;

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

        // acc_id
        $this->acc_id->HrefValue = "";
        $this->acc_id->TooltipValue = "";

        // paid_at
        $this->paid_at->HrefValue = "";
        $this->paid_at->TooltipValue = "";

        // departement_id
        $this->departement_id->HrefValue = "";
        $this->departement_id->TooltipValue = "";

        // type_id
        $this->type_id->HrefValue = "";
        $this->type_id->TooltipValue = "";

        // amount
        $this->amount->HrefValue = "";
        $this->amount->TooltipValue = "";

        // currency_code
        $this->currency_code->HrefValue = "";
        $this->currency_code->TooltipValue = "";

        // currency_rate
        $this->currency_rate->HrefValue = "";
        $this->currency_rate->TooltipValue = "";

        // document_id
        $this->document_id->HrefValue = "";
        $this->document_id->TooltipValue = "";

        // contact_id
        $this->contact_id->HrefValue = "";
        $this->contact_id->TooltipValue = "";

        // description
        $this->description->HrefValue = "";
        $this->description->TooltipValue = "";

        // acc_category_id
        $this->acc_category_id->HrefValue = "";
        $this->acc_category_id->TooltipValue = "";

        // payment_method
        $this->payment_method->HrefValue = "";
        $this->payment_method->TooltipValue = "";

        // reference
        $this->reference->HrefValue = "";
        $this->reference->TooltipValue = "";

        // parent_id
        $this->parent_id->HrefValue = "";
        $this->parent_id->TooltipValue = "";

        // reconciled
        $this->reconciled->HrefValue = "";
        $this->reconciled->TooltipValue = "";

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

        // acc_id
        $this->acc_id->setupEditAttributes();
        $this->acc_id->EditValue = $this->acc_id->CurrentValue;
        $this->acc_id->PlaceHolder = RemoveHtml($this->acc_id->caption());
        if (strval($this->acc_id->EditValue) != "" && is_numeric($this->acc_id->EditValue)) {
            $this->acc_id->EditValue = FormatNumber($this->acc_id->EditValue, null);
        }

        // paid_at
        $this->paid_at->setupEditAttributes();
        $this->paid_at->EditValue = FormatDateTime($this->paid_at->CurrentValue, $this->paid_at->formatPattern());
        $this->paid_at->PlaceHolder = RemoveHtml($this->paid_at->caption());

        // departement_id
        $this->departement_id->setupEditAttributes();
        $this->departement_id->EditValue = $this->departement_id->CurrentValue;
        $this->departement_id->PlaceHolder = RemoveHtml($this->departement_id->caption());
        if (strval($this->departement_id->EditValue) != "" && is_numeric($this->departement_id->EditValue)) {
            $this->departement_id->EditValue = FormatNumber($this->departement_id->EditValue, null);
        }

        // type_id
        $this->type_id->setupEditAttributes();
        $this->type_id->EditValue = $this->type_id->CurrentValue;
        $this->type_id->PlaceHolder = RemoveHtml($this->type_id->caption());
        if (strval($this->type_id->EditValue) != "" && is_numeric($this->type_id->EditValue)) {
            $this->type_id->EditValue = FormatNumber($this->type_id->EditValue, null);
        }

        // amount
        $this->amount->setupEditAttributes();
        $this->amount->EditValue = $this->amount->CurrentValue;
        $this->amount->PlaceHolder = RemoveHtml($this->amount->caption());
        if (strval($this->amount->EditValue) != "" && is_numeric($this->amount->EditValue)) {
            $this->amount->EditValue = FormatNumber($this->amount->EditValue, null);
        }

        // currency_code
        $this->currency_code->setupEditAttributes();
        if (!$this->currency_code->Raw) {
            $this->currency_code->CurrentValue = HtmlDecode($this->currency_code->CurrentValue);
        }
        $this->currency_code->EditValue = $this->currency_code->CurrentValue;
        $this->currency_code->PlaceHolder = RemoveHtml($this->currency_code->caption());

        // currency_rate
        $this->currency_rate->setupEditAttributes();
        $this->currency_rate->EditValue = $this->currency_rate->CurrentValue;
        $this->currency_rate->PlaceHolder = RemoveHtml($this->currency_rate->caption());
        if (strval($this->currency_rate->EditValue) != "" && is_numeric($this->currency_rate->EditValue)) {
            $this->currency_rate->EditValue = FormatNumber($this->currency_rate->EditValue, null);
        }

        // document_id
        $this->document_id->setupEditAttributes();
        $this->document_id->EditValue = $this->document_id->CurrentValue;
        $this->document_id->PlaceHolder = RemoveHtml($this->document_id->caption());
        if (strval($this->document_id->EditValue) != "" && is_numeric($this->document_id->EditValue)) {
            $this->document_id->EditValue = FormatNumber($this->document_id->EditValue, null);
        }

        // contact_id
        $this->contact_id->setupEditAttributes();
        $this->contact_id->EditValue = $this->contact_id->CurrentValue;
        $this->contact_id->PlaceHolder = RemoveHtml($this->contact_id->caption());
        if (strval($this->contact_id->EditValue) != "" && is_numeric($this->contact_id->EditValue)) {
            $this->contact_id->EditValue = FormatNumber($this->contact_id->EditValue, null);
        }

        // description
        $this->description->setupEditAttributes();
        $this->description->EditValue = $this->description->CurrentValue;
        $this->description->PlaceHolder = RemoveHtml($this->description->caption());

        // acc_category_id
        $this->acc_category_id->setupEditAttributes();
        $this->acc_category_id->EditValue = $this->acc_category_id->CurrentValue;
        $this->acc_category_id->PlaceHolder = RemoveHtml($this->acc_category_id->caption());
        if (strval($this->acc_category_id->EditValue) != "" && is_numeric($this->acc_category_id->EditValue)) {
            $this->acc_category_id->EditValue = FormatNumber($this->acc_category_id->EditValue, null);
        }

        // payment_method
        $this->payment_method->setupEditAttributes();
        if (!$this->payment_method->Raw) {
            $this->payment_method->CurrentValue = HtmlDecode($this->payment_method->CurrentValue);
        }
        $this->payment_method->EditValue = $this->payment_method->CurrentValue;
        $this->payment_method->PlaceHolder = RemoveHtml($this->payment_method->caption());

        // reference
        $this->reference->setupEditAttributes();
        if (!$this->reference->Raw) {
            $this->reference->CurrentValue = HtmlDecode($this->reference->CurrentValue);
        }
        $this->reference->EditValue = $this->reference->CurrentValue;
        $this->reference->PlaceHolder = RemoveHtml($this->reference->caption());

        // parent_id
        $this->parent_id->setupEditAttributes();
        $this->parent_id->EditValue = $this->parent_id->CurrentValue;
        $this->parent_id->PlaceHolder = RemoveHtml($this->parent_id->caption());
        if (strval($this->parent_id->EditValue) != "" && is_numeric($this->parent_id->EditValue)) {
            $this->parent_id->EditValue = FormatNumber($this->parent_id->EditValue, null);
        }

        // reconciled
        $this->reconciled->EditValue = $this->reconciled->options(false);
        $this->reconciled->PlaceHolder = RemoveHtml($this->reconciled->caption());

        // created_from
        $this->created_from->setupEditAttributes();
        if (!$this->created_from->Raw) {
            $this->created_from->CurrentValue = HtmlDecode($this->created_from->CurrentValue);
        }
        $this->created_from->EditValue = $this->created_from->CurrentValue;
        $this->created_from->PlaceHolder = RemoveHtml($this->created_from->caption());

        // created_by
        $this->created_by->setupEditAttributes();
        if (!$this->created_by->Raw) {
            $this->created_by->CurrentValue = HtmlDecode($this->created_by->CurrentValue);
        }
        $this->created_by->EditValue = $this->created_by->CurrentValue;
        $this->created_by->PlaceHolder = RemoveHtml($this->created_by->caption());

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
                    $doc->exportCaption($this->acc_id);
                    $doc->exportCaption($this->paid_at);
                    $doc->exportCaption($this->departement_id);
                    $doc->exportCaption($this->type_id);
                    $doc->exportCaption($this->amount);
                    $doc->exportCaption($this->currency_code);
                    $doc->exportCaption($this->currency_rate);
                    $doc->exportCaption($this->document_id);
                    $doc->exportCaption($this->contact_id);
                    $doc->exportCaption($this->description);
                    $doc->exportCaption($this->acc_category_id);
                    $doc->exportCaption($this->payment_method);
                    $doc->exportCaption($this->reference);
                    $doc->exportCaption($this->parent_id);
                    $doc->exportCaption($this->reconciled);
                    $doc->exportCaption($this->created_from);
                    $doc->exportCaption($this->created_by);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->deleted_at);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->acc_id);
                    $doc->exportCaption($this->paid_at);
                    $doc->exportCaption($this->departement_id);
                    $doc->exportCaption($this->type_id);
                    $doc->exportCaption($this->amount);
                    $doc->exportCaption($this->currency_code);
                    $doc->exportCaption($this->currency_rate);
                    $doc->exportCaption($this->document_id);
                    $doc->exportCaption($this->contact_id);
                    $doc->exportCaption($this->acc_category_id);
                    $doc->exportCaption($this->payment_method);
                    $doc->exportCaption($this->reference);
                    $doc->exportCaption($this->parent_id);
                    $doc->exportCaption($this->reconciled);
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
                        $doc->exportField($this->acc_id);
                        $doc->exportField($this->paid_at);
                        $doc->exportField($this->departement_id);
                        $doc->exportField($this->type_id);
                        $doc->exportField($this->amount);
                        $doc->exportField($this->currency_code);
                        $doc->exportField($this->currency_rate);
                        $doc->exportField($this->document_id);
                        $doc->exportField($this->contact_id);
                        $doc->exportField($this->description);
                        $doc->exportField($this->acc_category_id);
                        $doc->exportField($this->payment_method);
                        $doc->exportField($this->reference);
                        $doc->exportField($this->parent_id);
                        $doc->exportField($this->reconciled);
                        $doc->exportField($this->created_from);
                        $doc->exportField($this->created_by);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->deleted_at);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->acc_id);
                        $doc->exportField($this->paid_at);
                        $doc->exportField($this->departement_id);
                        $doc->exportField($this->type_id);
                        $doc->exportField($this->amount);
                        $doc->exportField($this->currency_code);
                        $doc->exportField($this->currency_rate);
                        $doc->exportField($this->document_id);
                        $doc->exportField($this->contact_id);
                        $doc->exportField($this->acc_category_id);
                        $doc->exportField($this->payment_method);
                        $doc->exportField($this->reference);
                        $doc->exportField($this->parent_id);
                        $doc->exportField($this->reconciled);
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
