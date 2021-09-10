<?php

// lets get the directory file contents
  include "wp-load.php";

      //What Directory do we want???
     $upload_dir = wp_upload_dir();

     //What Subdirectory do we want to delete files in??
     $folder = $upload_dir['basedir'] .'/woocommerce_uploads';

     //Get that file list!
     $files = list_files( $folder, 2 );

     //For each one of those files, perform the magic
     foreach ( $files as $file ) {

          //Is it even a regular file?
         if ( is_file( $file ) ) {

             // Well, how big is the file
             $filesize = size_format( filesize( $file ) );

             //What's your name there little buddy?
             $filename = basename( $file );

             //When's your birthday?
             $filedate =  date( "Y-m-d", filemtime($file)); //Get the file creation date

             //When are you scheduled to be deleted?
             $filescheduleddeletiondate = date("Y-m-d", strtotime("+7 days"));

             //Is it time to delete already?
             $filedeletiondate = date("Y-m-d", strtotime("-7 days"));

             //Umm, don't we need to know what your file extension is?
             $path = "/srv/users/freshysites/apps/cheapmedcards/public/wp-content/uploads/woocommerce_uploads/" . $filename; // Get the file
             $extension = pathinfo($path, PATHINFO_EXTENSION); // Get the extension
         }

         //Okay, so if you're an image or PDF file, and your time on the server is up, you got to go now
         if (($filedate <= $filedeletiondate) && ($extension == "png" || $extension == "jpg" || $extension == "pdf" || $extension == "svg")) {

					 echo "one file, two file, no file -- Successfully deleted " . $filename . "<br>";

           /* Need to add a file extension to the list? Just include as above.

           To include mp4 files in the funciton for example, copy and paste the following line after 'pdf'

           || $extension == 'mp4'
           */

          // Bye Bye, little buddy. This was fun.
          wp_delete_file("/wp-content/uploads/woocommerce_uploads/" . $filename); //KILL IT WITH FIRE
       }

	else {
		echo $filedeletiondate . " ";
		echo $filename . " " . " File Extension: " . $extension . "<br>";
	}
     }
