<?php
    class PostsGateway extends Adapter {
        public function _construct($connect) {
            parent::__construct($connect);
        }
        
        protected function getSelectStatement() {
            return "SELECT PostID, UserID, Title, Message, PostTime FROM Posts";
        }
        
        protected function getOrderFields() {
            return 'PostTime';
        }
        
        protected function getPrimaryKeyName() {
            return "PostID";
        }
    }

?>