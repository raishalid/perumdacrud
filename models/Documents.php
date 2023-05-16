<?php

namespace PHPMaker2023\crudperumdautama;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for documents
 */
class Documents extends DbTable
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
    public $departement_id;
    public $company_id;
    public $type;
    public $document_number;
    public $order_number;
    public $status;
    public $issued_at;
    public $due_at;
    public $amount;
    public $currency_code;
    public $currency_rate;
    public $category_id;
    public $contact_id;
    public $contact_name;
    public $contact_email;
    public $contact_tax_number;
    public $contact_phone;
    public $contact_address;
    public $contact_city;
    public $contact_zip_code;
    public $contact_state;
    public $contact_country;
    public $notes;
    public $footer;
    public $parent_id;
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
        $this->TableVar = "documents";
        $this->TableName = 'documents';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "documents";
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
        $this->company_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->company_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
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
        $this->type->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['type'] = &$this->type;

        // document_number
        $this->document_number = new DbField(
            $this, // Table
            'x_document_number', // Variable name
            'document_number', // Name
            '`document_number`', // Expression
            '`document_number`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`document_number`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->document_number->InputTextType = "text";
        $this->document_number->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['document_number'] = &$this->document_number;

        // order_number
        $this->order_number = new DbField(
            $this, // Table
            'x_order_number', // Variable name
            'order_number', // Name
            '`order_number`', // Expression
            '`order_number`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`order_number`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->order_number->InputTextType = "text";
        $this->order_number->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['order_number'] = &$this->order_number;

        // status
        $this->status = new DbField(
            $this, // Table
            'x_status', // Variable name
            'status', // Name
            '`status`', // Expression
            '`status`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`status`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->status->InputTextType = "text";
        $this->status->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['status'] = &$this->status;

        // issued_at
        $this->issued_at = new DbField(
            $this, // Table
            'x_issued_at', // Variable name
            'issued_at', // Name
            '`issued_at`', // Expression
            CastDateFieldForLike("`issued_at`", 0, "DB"), // Basic search expression
            135, // Type
            19, // Size
            0, // Date/Time format
            false, // Is upload field
            '`issued_at`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->issued_at->InputTextType = "text";
        $this->issued_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->issued_at->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['issued_at'] = &$this->issued_at;

        // due_at
        $this->due_at = new DbField(
            $this, // Table
            'x_due_at', // Variable name
            'due_at', // Name
            '`due_at`', // Expression
            CastDateFieldForLike("`due_at`", 0, "DB"), // Basic search expression
            135, // Type
            19, // Size
            0, // Date/Time format
            false, // Is upload field
            '`due_at`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->due_at->InputTextType = "text";
        $this->due_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->due_at->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['due_at'] = &$this->due_at;

        // amount
        $this->amount = new DbField(
            $this, // Table
            'x_amount', // Variable name
            'amount', // Name
            '`amount`', // Expression
            '`amount`', // Basic search expression
            5, // Type
            15, // Size
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
            15, // Size
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

        // category_id
        $this->category_id = new DbField(
            $this, // Table
            'x_category_id', // Variable name
            'category_id', // Name
            '`category_id`', // Expression
            '`category_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`category_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->category_id->addMethod("getDefault", fn() => 1);
        $this->category_id->InputTextType = "text";
        $this->category_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->category_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['category_id'] = &$this->category_id;

        // contact_id
        $this->contact_id = new DbField(
            $this, // Table
            'x_contact_id', // Variable name
            'contact_id', // Name
            '`contact_id`', // Expression
            '`contact_id`', // Basic search expression
            3, // Type
            11, // Size
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

        // contact_name
        $this->contact_name = new DbField(
            $this, // Table
            'x_contact_name', // Variable name
            'contact_name', // Name
            '`contact_name`', // Expression
            '`contact_name`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`contact_name`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->contact_name->InputTextType = "text";
        $this->contact_name->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['contact_name'] = &$this->contact_name;

        // contact_email
        $this->contact_email = new DbField(
            $this, // Table
            'x_contact_email', // Variable name
            'contact_email', // Name
            '`contact_email`', // Expression
            '`contact_email`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`contact_email`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->contact_email->InputTextType = "text";
        $this->contact_email->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['contact_email'] = &$this->contact_email;

        // contact_tax_number
        $this->contact_tax_number = new DbField(
            $this, // Table
            'x_contact_tax_number', // Variable name
            'contact_tax_number', // Name
            '`contact_tax_number`', // Expression
            '`contact_tax_number`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`contact_tax_number`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->contact_tax_number->InputTextType = "text";
        $this->contact_tax_number->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['contact_tax_number'] = &$this->contact_tax_number;

        // contact_phone
        $this->contact_phone = new DbField(
            $this, // Table
            'x_contact_phone', // Variable name
            'contact_phone', // Name
            '`contact_phone`', // Expression
            '`contact_phone`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`contact_phone`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->contact_phone->InputTextType = "text";
        $this->contact_phone->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['contact_phone'] = &$this->contact_phone;

        // contact_address
        $this->contact_address = new DbField(
            $this, // Table
            'x_contact_address', // Variable name
            'contact_address', // Name
            '`contact_address`', // Expression
            '`contact_address`', // Basic search expression
            201, // Type
            65535, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`contact_address`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->contact_address->InputTextType = "text";
        $this->contact_address->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['contact_address'] = &$this->contact_address;

        // contact_city
        $this->contact_city = new DbField(
            $this, // Table
            'x_contact_city', // Variable name
            'contact_city', // Name
            '`contact_city`', // Expression
            '`contact_city`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`contact_city`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->contact_city->InputTextType = "text";
        $this->contact_city->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['contact_city'] = &$this->contact_city;

        // contact_zip_code
        $this->contact_zip_code = new DbField(
            $this, // Table
            'x_contact_zip_code', // Variable name
            'contact_zip_code', // Name
            '`contact_zip_code`', // Expression
            '`contact_zip_code`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`contact_zip_code`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->contact_zip_code->InputTextType = "text";
        $this->contact_zip_code->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['contact_zip_code'] = &$this->contact_zip_code;

        // contact_state
        $this->contact_state = new DbField(
            $this, // Table
            'x_contact_state', // Variable name
            'contact_state', // Name
            '`contact_state`', // Expression
            '`contact_state`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`contact_state`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->contact_state->InputTextType = "text";
        $this->contact_state->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['contact_state'] = &$this->contact_state;

        // contact_country
        $this->contact_country = new DbField(
            $this, // Table
            'x_contact_country', // Variable name
            'contact_country', // Name
            '`contact_country`', // Expression
            '`contact_country`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`contact_country`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->contact_country->InputTextType = "text";
        $this->contact_country->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['contact_country'] = &$this->contact_country;

        // notes
        $this->notes = new DbField(
            $this, // Table
            'x_notes', // Variable name
            'notes', // Name
            '`notes`', // Expression
            '`notes`', // Basic search expression
            201, // Type
            65535, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`notes`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->notes->InputTextType = "text";
        $this->notes->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['notes'] = &$this->notes;

        // footer
        $this->footer = new DbField(
            $this, // Table
            'x_footer', // Variable name
            'footer', // Name
            '`footer`', // Expression
            '`footer`', // Basic search expression
            201, // Type
            65535, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`footer`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->footer->InputTextType = "text";
        $this->footer->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['footer'] = &$this->footer;

        // parent_id
        $this->parent_id = new DbField(
            $this, // Table
            'x_parent_id', // Variable name
            'parent_id', // Name
            '`parent_id`', // Expression
            '`parent_id`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`parent_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->parent_id->addMethod("getDefault", fn() => 0);
        $this->parent_id->InputTextType = "text";
        $this->parent_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->parent_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['parent_id'] = &$this->parent_id;

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
            3, // Type
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "documents";
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
        $this->departement_id->DbValue = $row['departement_id'];
        $this->company_id->DbValue = $row['company_id'];
        $this->type->DbValue = $row['type'];
        $this->document_number->DbValue = $row['document_number'];
        $this->order_number->DbValue = $row['order_number'];
        $this->status->DbValue = $row['status'];
        $this->issued_at->DbValue = $row['issued_at'];
        $this->due_at->DbValue = $row['due_at'];
        $this->amount->DbValue = $row['amount'];
        $this->currency_code->DbValue = $row['currency_code'];
        $this->currency_rate->DbValue = $row['currency_rate'];
        $this->category_id->DbValue = $row['category_id'];
        $this->contact_id->DbValue = $row['contact_id'];
        $this->contact_name->DbValue = $row['contact_name'];
        $this->contact_email->DbValue = $row['contact_email'];
        $this->contact_tax_number->DbValue = $row['contact_tax_number'];
        $this->contact_phone->DbValue = $row['contact_phone'];
        $this->contact_address->DbValue = $row['contact_address'];
        $this->contact_city->DbValue = $row['contact_city'];
        $this->contact_zip_code->DbValue = $row['contact_zip_code'];
        $this->contact_state->DbValue = $row['contact_state'];
        $this->contact_country->DbValue = $row['contact_country'];
        $this->notes->DbValue = $row['notes'];
        $this->footer->DbValue = $row['footer'];
        $this->parent_id->DbValue = $row['parent_id'];
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
        return $_SESSION[$name] ?? GetUrl("DocumentsList");
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
        if ($pageName == "DocumentsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "DocumentsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "DocumentsAdd") {
            return $Language->phrase("Add");
        }
        return "";
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "DocumentsView";
            case Config("API_ADD_ACTION"):
                return "DocumentsAdd";
            case Config("API_EDIT_ACTION"):
                return "DocumentsEdit";
            case Config("API_DELETE_ACTION"):
                return "DocumentsDelete";
            case Config("API_LIST_ACTION"):
                return "DocumentsList";
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
        return "DocumentsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("DocumentsView", $parm);
        } else {
            $url = $this->keyUrl("DocumentsView", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "DocumentsAdd?" . $parm;
        } else {
            $url = "DocumentsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("DocumentsEdit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("DocumentsList", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("DocumentsAdd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("DocumentsList", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("DocumentsDelete");
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
        $this->departement_id->setDbValue($row['departement_id']);
        $this->company_id->setDbValue($row['company_id']);
        $this->type->setDbValue($row['type']);
        $this->document_number->setDbValue($row['document_number']);
        $this->order_number->setDbValue($row['order_number']);
        $this->status->setDbValue($row['status']);
        $this->issued_at->setDbValue($row['issued_at']);
        $this->due_at->setDbValue($row['due_at']);
        $this->amount->setDbValue($row['amount']);
        $this->currency_code->setDbValue($row['currency_code']);
        $this->currency_rate->setDbValue($row['currency_rate']);
        $this->category_id->setDbValue($row['category_id']);
        $this->contact_id->setDbValue($row['contact_id']);
        $this->contact_name->setDbValue($row['contact_name']);
        $this->contact_email->setDbValue($row['contact_email']);
        $this->contact_tax_number->setDbValue($row['contact_tax_number']);
        $this->contact_phone->setDbValue($row['contact_phone']);
        $this->contact_address->setDbValue($row['contact_address']);
        $this->contact_city->setDbValue($row['contact_city']);
        $this->contact_zip_code->setDbValue($row['contact_zip_code']);
        $this->contact_state->setDbValue($row['contact_state']);
        $this->contact_country->setDbValue($row['contact_country']);
        $this->notes->setDbValue($row['notes']);
        $this->footer->setDbValue($row['footer']);
        $this->parent_id->setDbValue($row['parent_id']);
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
        $listPage = "DocumentsList";
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

        // departement_id

        // company_id

        // type

        // document_number

        // order_number

        // status

        // issued_at

        // due_at

        // amount

        // currency_code

        // currency_rate

        // category_id

        // contact_id

        // contact_name

        // contact_email

        // contact_tax_number

        // contact_phone

        // contact_address

        // contact_city

        // contact_zip_code

        // contact_state

        // contact_country

        // notes

        // footer

        // parent_id

        // created_from

        // created_by

        // created_at

        // updated_at

        // deleted_at

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewValue = FormatNumber($this->id->ViewValue, $this->id->formatPattern());

        // departement_id
        $this->departement_id->ViewValue = $this->departement_id->CurrentValue;
        $this->departement_id->ViewValue = FormatNumber($this->departement_id->ViewValue, $this->departement_id->formatPattern());

        // company_id
        $this->company_id->ViewValue = $this->company_id->CurrentValue;
        $this->company_id->ViewValue = FormatNumber($this->company_id->ViewValue, $this->company_id->formatPattern());

        // type
        $this->type->ViewValue = $this->type->CurrentValue;

        // document_number
        $this->document_number->ViewValue = $this->document_number->CurrentValue;

        // order_number
        $this->order_number->ViewValue = $this->order_number->CurrentValue;

        // status
        $this->status->ViewValue = $this->status->CurrentValue;

        // issued_at
        $this->issued_at->ViewValue = $this->issued_at->CurrentValue;
        $this->issued_at->ViewValue = FormatDateTime($this->issued_at->ViewValue, $this->issued_at->formatPattern());

        // due_at
        $this->due_at->ViewValue = $this->due_at->CurrentValue;
        $this->due_at->ViewValue = FormatDateTime($this->due_at->ViewValue, $this->due_at->formatPattern());

        // amount
        $this->amount->ViewValue = $this->amount->CurrentValue;
        $this->amount->ViewValue = FormatNumber($this->amount->ViewValue, $this->amount->formatPattern());

        // currency_code
        $this->currency_code->ViewValue = $this->currency_code->CurrentValue;

        // currency_rate
        $this->currency_rate->ViewValue = $this->currency_rate->CurrentValue;
        $this->currency_rate->ViewValue = FormatNumber($this->currency_rate->ViewValue, $this->currency_rate->formatPattern());

        // category_id
        $this->category_id->ViewValue = $this->category_id->CurrentValue;
        $this->category_id->ViewValue = FormatNumber($this->category_id->ViewValue, $this->category_id->formatPattern());

        // contact_id
        $this->contact_id->ViewValue = $this->contact_id->CurrentValue;
        $this->contact_id->ViewValue = FormatNumber($this->contact_id->ViewValue, $this->contact_id->formatPattern());

        // contact_name
        $this->contact_name->ViewValue = $this->contact_name->CurrentValue;

        // contact_email
        $this->contact_email->ViewValue = $this->contact_email->CurrentValue;

        // contact_tax_number
        $this->contact_tax_number->ViewValue = $this->contact_tax_number->CurrentValue;

        // contact_phone
        $this->contact_phone->ViewValue = $this->contact_phone->CurrentValue;

        // contact_address
        $this->contact_address->ViewValue = $this->contact_address->CurrentValue;

        // contact_city
        $this->contact_city->ViewValue = $this->contact_city->CurrentValue;

        // contact_zip_code
        $this->contact_zip_code->ViewValue = $this->contact_zip_code->CurrentValue;

        // contact_state
        $this->contact_state->ViewValue = $this->contact_state->CurrentValue;

        // contact_country
        $this->contact_country->ViewValue = $this->contact_country->CurrentValue;

        // notes
        $this->notes->ViewValue = $this->notes->CurrentValue;

        // footer
        $this->footer->ViewValue = $this->footer->CurrentValue;

        // parent_id
        $this->parent_id->ViewValue = $this->parent_id->CurrentValue;
        $this->parent_id->ViewValue = FormatNumber($this->parent_id->ViewValue, $this->parent_id->formatPattern());

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

        // departement_id
        $this->departement_id->HrefValue = "";
        $this->departement_id->TooltipValue = "";

        // company_id
        $this->company_id->HrefValue = "";
        $this->company_id->TooltipValue = "";

        // type
        $this->type->HrefValue = "";
        $this->type->TooltipValue = "";

        // document_number
        $this->document_number->HrefValue = "";
        $this->document_number->TooltipValue = "";

        // order_number
        $this->order_number->HrefValue = "";
        $this->order_number->TooltipValue = "";

        // status
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // issued_at
        $this->issued_at->HrefValue = "";
        $this->issued_at->TooltipValue = "";

        // due_at
        $this->due_at->HrefValue = "";
        $this->due_at->TooltipValue = "";

        // amount
        $this->amount->HrefValue = "";
        $this->amount->TooltipValue = "";

        // currency_code
        $this->currency_code->HrefValue = "";
        $this->currency_code->TooltipValue = "";

        // currency_rate
        $this->currency_rate->HrefValue = "";
        $this->currency_rate->TooltipValue = "";

        // category_id
        $this->category_id->HrefValue = "";
        $this->category_id->TooltipValue = "";

        // contact_id
        $this->contact_id->HrefValue = "";
        $this->contact_id->TooltipValue = "";

        // contact_name
        $this->contact_name->HrefValue = "";
        $this->contact_name->TooltipValue = "";

        // contact_email
        $this->contact_email->HrefValue = "";
        $this->contact_email->TooltipValue = "";

        // contact_tax_number
        $this->contact_tax_number->HrefValue = "";
        $this->contact_tax_number->TooltipValue = "";

        // contact_phone
        $this->contact_phone->HrefValue = "";
        $this->contact_phone->TooltipValue = "";

        // contact_address
        $this->contact_address->HrefValue = "";
        $this->contact_address->TooltipValue = "";

        // contact_city
        $this->contact_city->HrefValue = "";
        $this->contact_city->TooltipValue = "";

        // contact_zip_code
        $this->contact_zip_code->HrefValue = "";
        $this->contact_zip_code->TooltipValue = "";

        // contact_state
        $this->contact_state->HrefValue = "";
        $this->contact_state->TooltipValue = "";

        // contact_country
        $this->contact_country->HrefValue = "";
        $this->contact_country->TooltipValue = "";

        // notes
        $this->notes->HrefValue = "";
        $this->notes->TooltipValue = "";

        // footer
        $this->footer->HrefValue = "";
        $this->footer->TooltipValue = "";

        // parent_id
        $this->parent_id->HrefValue = "";
        $this->parent_id->TooltipValue = "";

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

        // departement_id
        $this->departement_id->setupEditAttributes();
        $this->departement_id->EditValue = $this->departement_id->CurrentValue;
        $this->departement_id->PlaceHolder = RemoveHtml($this->departement_id->caption());
        if (strval($this->departement_id->EditValue) != "" && is_numeric($this->departement_id->EditValue)) {
            $this->departement_id->EditValue = FormatNumber($this->departement_id->EditValue, null);
        }

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

        // document_number
        $this->document_number->setupEditAttributes();
        if (!$this->document_number->Raw) {
            $this->document_number->CurrentValue = HtmlDecode($this->document_number->CurrentValue);
        }
        $this->document_number->EditValue = $this->document_number->CurrentValue;
        $this->document_number->PlaceHolder = RemoveHtml($this->document_number->caption());

        // order_number
        $this->order_number->setupEditAttributes();
        if (!$this->order_number->Raw) {
            $this->order_number->CurrentValue = HtmlDecode($this->order_number->CurrentValue);
        }
        $this->order_number->EditValue = $this->order_number->CurrentValue;
        $this->order_number->PlaceHolder = RemoveHtml($this->order_number->caption());

        // status
        $this->status->setupEditAttributes();
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // issued_at
        $this->issued_at->setupEditAttributes();
        $this->issued_at->EditValue = FormatDateTime($this->issued_at->CurrentValue, $this->issued_at->formatPattern());
        $this->issued_at->PlaceHolder = RemoveHtml($this->issued_at->caption());

        // due_at
        $this->due_at->setupEditAttributes();
        $this->due_at->EditValue = FormatDateTime($this->due_at->CurrentValue, $this->due_at->formatPattern());
        $this->due_at->PlaceHolder = RemoveHtml($this->due_at->caption());

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

        // category_id
        $this->category_id->setupEditAttributes();
        $this->category_id->EditValue = $this->category_id->CurrentValue;
        $this->category_id->PlaceHolder = RemoveHtml($this->category_id->caption());
        if (strval($this->category_id->EditValue) != "" && is_numeric($this->category_id->EditValue)) {
            $this->category_id->EditValue = FormatNumber($this->category_id->EditValue, null);
        }

        // contact_id
        $this->contact_id->setupEditAttributes();
        $this->contact_id->EditValue = $this->contact_id->CurrentValue;
        $this->contact_id->PlaceHolder = RemoveHtml($this->contact_id->caption());
        if (strval($this->contact_id->EditValue) != "" && is_numeric($this->contact_id->EditValue)) {
            $this->contact_id->EditValue = FormatNumber($this->contact_id->EditValue, null);
        }

        // contact_name
        $this->contact_name->setupEditAttributes();
        if (!$this->contact_name->Raw) {
            $this->contact_name->CurrentValue = HtmlDecode($this->contact_name->CurrentValue);
        }
        $this->contact_name->EditValue = $this->contact_name->CurrentValue;
        $this->contact_name->PlaceHolder = RemoveHtml($this->contact_name->caption());

        // contact_email
        $this->contact_email->setupEditAttributes();
        if (!$this->contact_email->Raw) {
            $this->contact_email->CurrentValue = HtmlDecode($this->contact_email->CurrentValue);
        }
        $this->contact_email->EditValue = $this->contact_email->CurrentValue;
        $this->contact_email->PlaceHolder = RemoveHtml($this->contact_email->caption());

        // contact_tax_number
        $this->contact_tax_number->setupEditAttributes();
        if (!$this->contact_tax_number->Raw) {
            $this->contact_tax_number->CurrentValue = HtmlDecode($this->contact_tax_number->CurrentValue);
        }
        $this->contact_tax_number->EditValue = $this->contact_tax_number->CurrentValue;
        $this->contact_tax_number->PlaceHolder = RemoveHtml($this->contact_tax_number->caption());

        // contact_phone
        $this->contact_phone->setupEditAttributes();
        if (!$this->contact_phone->Raw) {
            $this->contact_phone->CurrentValue = HtmlDecode($this->contact_phone->CurrentValue);
        }
        $this->contact_phone->EditValue = $this->contact_phone->CurrentValue;
        $this->contact_phone->PlaceHolder = RemoveHtml($this->contact_phone->caption());

        // contact_address
        $this->contact_address->setupEditAttributes();
        $this->contact_address->EditValue = $this->contact_address->CurrentValue;
        $this->contact_address->PlaceHolder = RemoveHtml($this->contact_address->caption());

        // contact_city
        $this->contact_city->setupEditAttributes();
        if (!$this->contact_city->Raw) {
            $this->contact_city->CurrentValue = HtmlDecode($this->contact_city->CurrentValue);
        }
        $this->contact_city->EditValue = $this->contact_city->CurrentValue;
        $this->contact_city->PlaceHolder = RemoveHtml($this->contact_city->caption());

        // contact_zip_code
        $this->contact_zip_code->setupEditAttributes();
        if (!$this->contact_zip_code->Raw) {
            $this->contact_zip_code->CurrentValue = HtmlDecode($this->contact_zip_code->CurrentValue);
        }
        $this->contact_zip_code->EditValue = $this->contact_zip_code->CurrentValue;
        $this->contact_zip_code->PlaceHolder = RemoveHtml($this->contact_zip_code->caption());

        // contact_state
        $this->contact_state->setupEditAttributes();
        if (!$this->contact_state->Raw) {
            $this->contact_state->CurrentValue = HtmlDecode($this->contact_state->CurrentValue);
        }
        $this->contact_state->EditValue = $this->contact_state->CurrentValue;
        $this->contact_state->PlaceHolder = RemoveHtml($this->contact_state->caption());

        // contact_country
        $this->contact_country->setupEditAttributes();
        if (!$this->contact_country->Raw) {
            $this->contact_country->CurrentValue = HtmlDecode($this->contact_country->CurrentValue);
        }
        $this->contact_country->EditValue = $this->contact_country->CurrentValue;
        $this->contact_country->PlaceHolder = RemoveHtml($this->contact_country->caption());

        // notes
        $this->notes->setupEditAttributes();
        $this->notes->EditValue = $this->notes->CurrentValue;
        $this->notes->PlaceHolder = RemoveHtml($this->notes->caption());

        // footer
        $this->footer->setupEditAttributes();
        $this->footer->EditValue = $this->footer->CurrentValue;
        $this->footer->PlaceHolder = RemoveHtml($this->footer->caption());

        // parent_id
        $this->parent_id->setupEditAttributes();
        $this->parent_id->EditValue = $this->parent_id->CurrentValue;
        $this->parent_id->PlaceHolder = RemoveHtml($this->parent_id->caption());
        if (strval($this->parent_id->EditValue) != "" && is_numeric($this->parent_id->EditValue)) {
            $this->parent_id->EditValue = FormatNumber($this->parent_id->EditValue, null);
        }

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
                    $doc->exportCaption($this->departement_id);
                    $doc->exportCaption($this->company_id);
                    $doc->exportCaption($this->type);
                    $doc->exportCaption($this->document_number);
                    $doc->exportCaption($this->order_number);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->issued_at);
                    $doc->exportCaption($this->due_at);
                    $doc->exportCaption($this->amount);
                    $doc->exportCaption($this->currency_code);
                    $doc->exportCaption($this->currency_rate);
                    $doc->exportCaption($this->category_id);
                    $doc->exportCaption($this->contact_id);
                    $doc->exportCaption($this->contact_name);
                    $doc->exportCaption($this->contact_email);
                    $doc->exportCaption($this->contact_tax_number);
                    $doc->exportCaption($this->contact_phone);
                    $doc->exportCaption($this->contact_address);
                    $doc->exportCaption($this->contact_city);
                    $doc->exportCaption($this->contact_zip_code);
                    $doc->exportCaption($this->contact_state);
                    $doc->exportCaption($this->contact_country);
                    $doc->exportCaption($this->notes);
                    $doc->exportCaption($this->footer);
                    $doc->exportCaption($this->parent_id);
                    $doc->exportCaption($this->created_from);
                    $doc->exportCaption($this->created_by);
                    $doc->exportCaption($this->created_at);
                    $doc->exportCaption($this->updated_at);
                    $doc->exportCaption($this->deleted_at);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->departement_id);
                    $doc->exportCaption($this->company_id);
                    $doc->exportCaption($this->type);
                    $doc->exportCaption($this->document_number);
                    $doc->exportCaption($this->order_number);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->issued_at);
                    $doc->exportCaption($this->due_at);
                    $doc->exportCaption($this->amount);
                    $doc->exportCaption($this->currency_code);
                    $doc->exportCaption($this->currency_rate);
                    $doc->exportCaption($this->category_id);
                    $doc->exportCaption($this->contact_id);
                    $doc->exportCaption($this->contact_name);
                    $doc->exportCaption($this->contact_email);
                    $doc->exportCaption($this->contact_tax_number);
                    $doc->exportCaption($this->contact_phone);
                    $doc->exportCaption($this->contact_city);
                    $doc->exportCaption($this->contact_zip_code);
                    $doc->exportCaption($this->contact_state);
                    $doc->exportCaption($this->contact_country);
                    $doc->exportCaption($this->parent_id);
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
                        $doc->exportField($this->departement_id);
                        $doc->exportField($this->company_id);
                        $doc->exportField($this->type);
                        $doc->exportField($this->document_number);
                        $doc->exportField($this->order_number);
                        $doc->exportField($this->status);
                        $doc->exportField($this->issued_at);
                        $doc->exportField($this->due_at);
                        $doc->exportField($this->amount);
                        $doc->exportField($this->currency_code);
                        $doc->exportField($this->currency_rate);
                        $doc->exportField($this->category_id);
                        $doc->exportField($this->contact_id);
                        $doc->exportField($this->contact_name);
                        $doc->exportField($this->contact_email);
                        $doc->exportField($this->contact_tax_number);
                        $doc->exportField($this->contact_phone);
                        $doc->exportField($this->contact_address);
                        $doc->exportField($this->contact_city);
                        $doc->exportField($this->contact_zip_code);
                        $doc->exportField($this->contact_state);
                        $doc->exportField($this->contact_country);
                        $doc->exportField($this->notes);
                        $doc->exportField($this->footer);
                        $doc->exportField($this->parent_id);
                        $doc->exportField($this->created_from);
                        $doc->exportField($this->created_by);
                        $doc->exportField($this->created_at);
                        $doc->exportField($this->updated_at);
                        $doc->exportField($this->deleted_at);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->departement_id);
                        $doc->exportField($this->company_id);
                        $doc->exportField($this->type);
                        $doc->exportField($this->document_number);
                        $doc->exportField($this->order_number);
                        $doc->exportField($this->status);
                        $doc->exportField($this->issued_at);
                        $doc->exportField($this->due_at);
                        $doc->exportField($this->amount);
                        $doc->exportField($this->currency_code);
                        $doc->exportField($this->currency_rate);
                        $doc->exportField($this->category_id);
                        $doc->exportField($this->contact_id);
                        $doc->exportField($this->contact_name);
                        $doc->exportField($this->contact_email);
                        $doc->exportField($this->contact_tax_number);
                        $doc->exportField($this->contact_phone);
                        $doc->exportField($this->contact_city);
                        $doc->exportField($this->contact_zip_code);
                        $doc->exportField($this->contact_state);
                        $doc->exportField($this->contact_country);
                        $doc->exportField($this->parent_id);
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
