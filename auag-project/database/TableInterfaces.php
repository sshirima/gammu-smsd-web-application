<?php

interface InboxTable {
    
   public function dbconnect(); 
 
   public function getAllInboxSMS(array $returnColumns);
   
   public function getInboxSMS(array $returnColumns, array $selection, array $selectionArgs);
   
   public function updateInboxSMS($smsId, array $columnname, array $columnsvalues);
}

interface OutboxTable {
    
   public function dbconnect(); 
   
   public function getAllOutboxSMS(array $returnColumns);
   
   public function getOutboxSMS(array $returnColumns, array $selection, array $selectionArgs);
   
   public function updateOutboxSMS($smsId, array $columnname, array $columnsvalues);
   
   public function deleteOutBoxSMS($smsId);
}

interface SentItemsTable {
   
   public function dbconnect(); 
   
   public function getAllSentSMS(array $returnColumns);
   
   public function getSentSMS(array $returnColumns, array $selection, array $selectionArgs);
   
   public function updateSentSMS($smsId, array $columnname, array $columnsvalues);
   
   public function deleteSentSMS($smsId);
}

interface MembersInterface {
    
   public function dbconnect(); 
    
   public function getAllMembers(array $returnColumns);
   
   public function getMember(array $returnColumns, array $selection, array $selectionArgs);
   
   public function updateMember($memeberId, array $columnname, array $columnsvalues);
   
   public function deleteMemberById($memberId);
   
   public function addMember(array $columnname, array $columnsvalues);
}

