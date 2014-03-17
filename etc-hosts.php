<?php
/**
 * This is a simple webpage that loops through the /etc/hosts file for navigation of projects
 * The file looks for a line that is starts with 127.0.0.1 before writing out links
 * Any line after the first link will search for '#', and use the text as a header
 *
 * Add this file to the root of your web projects folder
 *
 * Example hosts file
 *
 * ##
 * # Host Database
 * #
 * # localhost is used to configure the loopback interface
 * # when the system is booting.  Do not change this entry.
 * ##
 * 127.0.0.1   localhost
 * 255.255.255.255 broadcasthost
 * ::1             localhost
 * fe80::1%lo0 localhost
 *
 * # Project Type/Name
 * 127.0.0.1   local.projectname.com
 *
 */

$content = 'includes/etc-hosts.php';
include('includes/layout.php');