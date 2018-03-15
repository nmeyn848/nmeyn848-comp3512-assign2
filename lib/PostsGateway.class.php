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
        protected function getViaJoinUsers(){
            return "SELECT PostID, Posts.UserID, Users.UserID, Users.FirstName, Users.LastName, Title, Message, PostTime FROM Posts, Users WHERE Posts.UserID = Users.UserID";
        }
        
        protected function getViaJoinImages(){
            return "SELECT PostID, Posts.MainPostImage, ImageDetails.ImageID, ImageDetails.Path FROM Posts, ImageDetails WHERE Posts.MainPostImage = ImageDetails.ImageID";
        }
    }

?>