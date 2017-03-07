<?php
 class DatabaseConfig{
    /**
     * These are basic database configuration
     * @var type 
     */
    public static $_serverName = "localhost";
    public static $_username = "root";
    public static $_password = "root";
    public static $_dbname = "smsd";
    
    /**
     * Table Members and colum name
     */
    public static $table_members = "members";
    public static $members_id = "memberID";
    public static $members_phonenumber = "phonenumber";
    public static $members_firstname = "Firstname";
    public static $members_lastname = "Lastname";
    public static $members_shares = "shares";
    public static $members_currency = "currency";
    public static $members_pending_jamii = "pending_jamii";
    public static $members_pending_fines = "pending_fines";
    public static $members_NOR_date = "NOR_date";
    public static $members_NR_amount = "NR_amount";
    public static $members_TP_Marejesho = "TP_marejesho";
    public static $members_Password= "password";
    public static $members_LP_progress = "LP_progress";
    public static $members_end_loan_date = "end_loan_date";
    
    /**
     * Table OutboxItems and colum names
     */
    public static $table_outbox = "outbox";
    public static $outbox_updatedInDB = "UpdatedInDB";
    public static $outbox_InsertIntoDB = "InsertIntoDB";
    public static $outbox_SendingDateTime = "SendingDateTime";
    public static $outbox_SendBefore = "SendBefore";
    public static $outbox_SendAfter = "SendAfter";
    public static $outbox_Text = "Text";
    public static $outbox_DestinationNumber = "DestinationNumber";
    public static $outbox_Coding = "Coding";
    public static $outbox_UDH = "UDH";
    public static $outbox_Class = "Class";
    public static $outbox_TextDecoded = "TextDecoded";
    public static $outbox_ID = "ID";
    public static $outbox_MultiPart = "MultiPart";
    public static $outbox_RelativeValidity = "RelativeValidity";
    public static $outbox_SenderID = "SenderID";
    public static $outbox_SendingTimeOut = "SendingTimeOut";
    public static $outbox_DeliveryReport = "DeliveryReport";
    public static $outbox_CreatorID = "CreatorID";
    public static $outbox_Retries = "Retries";
    public static $outbox_Priority = "Priority";
    
     /**
     * Table InboxItems and colum names
     */
    public static $table_inbox = "inbox";
    public static $inbox_UpdatedInDB = "UpdatedInDB";
    public static $inbox_ReceivingDateTime = "ReceivingDateTime";
    public static $inbox_Text = "Text";
    public static $inbox_SenderNumber = "SenderNumber";
    public static $inbox_Coding = "Coding";
    public static $inbox_UDH = "UDH";
    public static $inbox_SMSCNumber = "SMSCNumber";
    public static $inbox_Class = "Class";
    public static $inbox_TextDecoded = "TextDecoded";
    public static $inbox_ID = "ID";
    public static $inbox_RecipientID = "RecipientID";
    public static $inbox_Processed = "Processed";
    
    /**
     * Table SentItems and colum names
     */
    public static $table_sentitems = "sentitems";
    public static $sentitems_updatedInDB = "UpdatedInDB";
    public static $sentitems_InsertIntoDB = "InsertIntoDB";
    public static $sentitems_SendingDateTime = "SendingDateTime";
    public static $sentitems_DeliveryDateTime = "DeliveryDateTime";
    public static $sentitems_Text = "Text";
    public static $sentitems_DestinationNumber = "DestinationNumber";
    public static $sentitems_Coding = "Coding";
    public static $sentitems_UDH = "UDH";
    public static $sentitems_SMSCNumber = "SMSCNumber";
    public static $sentitems_Class = "Class";
    public static $sentitems_TextDecoded = "TextDecoded";
    public static $sentitems_ID = "ID";
    public static $sentitems_SenderID = "SenderID";
    public static $sentitems_SequencePosition = "SequencePosition";
    public static $sentitems_Status = "Status";
    public static $sentitems_StatusError = "StatusError";
    public static $sentitems_TPMR = "TPMR";
    public static $sentitems_CreatorID = "CreatorID";
    public static $sentitems_RelativeValidity = "RelativeValidity";
 }

