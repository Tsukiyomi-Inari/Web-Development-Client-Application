<?php 
/*
 *
 * @author Katherine Bellman <katherine.bellman@dcmail.ca>
 * @Student Id:100325825
 * @course: WEBD3201
 * @Date: September 12, 2021
 * 
 * 
 */

    /******* COOKIES ******/
    define("COOKIE_LIFESPAN", "259000"); // NOTE: 60x60x24x30 aka default value of one month

    /******* USER TYPES ********/

    define("ADMIN","s");
    define("AGENT","a");
    define("CLIENT","c");
    define("PENDING","p");
    define("DISABLED","d");

    /******** DATABASE CONSTANTS*********/

    define ("DB_HOST", "127.0.0.1");
    define ("DATABASE","bellmank_db");
    define ("DB_ADMIN", "bellmank");
    define ("DB_PORT", "5432");
    define ("DB_PASSWORD", "Webd2022@2020b");


    
?>