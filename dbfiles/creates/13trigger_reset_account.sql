CREATE TRIGGER `reset_account` BEFORE UPDATE ON `users`
 FOR EACH ROW 
 IF (NEW.activated_user = 0) THEN SET NEW.password_user = "163ee9847a2b5b7441f33aa23ec31304";
 END IF;
 
