<!-- Changed by:
Developer: Werbeagentur Hauer-Heinrich GmbH
Contact: web@hauer-heinrich.de
-->

<!-- Original by:
Name: TYPO3 Check Server Compatibility
Desc: You can check the current server configuration and compatibility for the seletec TYPO3 version. Also, You can check the Database connection and Check if the server can send the Email or not.
Developer: NITSAN Technologies Pvt. Ltd.
Date: 25th April 2018
Contact: info@nitsan.in
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TYPO3: Check Server Configurations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
        }
        body {
            height: 100%;
            width: 100%;
            font-size: 14px;
            color: #222222;
            font-family: "Roboto",sans-serif;
        }
        .wrapper {
            max-width: 1170px;
            width: 100%;
            margin: 0 auto;
        }
        .text-center {
            text-align: center;
        }
        .form-wrapper {
            margin: 52px 0;
            display: inline-block;
            width: 100%;
            position: relative;
        }
        .form-element {
            margin-bottom: 20px;
        }
        input, select {
            color: inherit;
            font-size: 13px;
            font-weight: 400;
            height: 36px;
            line-height: normal;
            margin: 0;
            min-width: 165px;
            outline: medium none !important;
            padding: 0 10px;
        }
        select {
            min-width: 187px;
        }
        input[type="submit"] {
            background-color: #ee8433;
            border: 1px solid #ee8433;
            border-radius: 0;
            color: #fff;
            box-shadow: none;
            cursor: pointer;
            font-weight: 700;
            min-width: 105px;
            -webkit-transition: all 0.3s ease-in-out 0s;
            transition: all 0.3s ease-in-out 0s;
            outline: none;
        }
        label {
            color: rgba(0, 0, 0, 0.7);
            display: inline-block;
            font-size: 16px;
            font-weight: 500;
            margin: 0 0 13px;
            width: 100%;
        }
        form > label {
            font-weight: bold;
        }
        .inline-label {
            float: left;
            margin: 8px 20px 8px 0;
            width: auto;
        }
        select option {
            outline: none;
            padding-left: 5px;
        }
        select:focus {
            outline: none !important;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .infor-table-wrapper {
            overflow: auto;
            width: 100%;
        }
        table {
            background-color: #fafafa;
            border: 1px solid #cccccc;
            margin-bottom: 18px;
            max-width: 100%;
            width: 100%;
            text-align: left;
            border-collapse: collapse;
            border-spacing: 0;
        }
        table > thead > tr {
            background-color: #ededed;
        }
        th,td {
            border: 1px solid #cccccc;
            line-height: 1.5;
            padding: 9px 15px;
            vertical-align: middle;
        }
        table th {
            border-bottom: 1px solid #cccccc;
            border-top: 0 none;
        }
        .clearfix:after {
            clear: both;
            content: "";
            display: block;
        }
        .text-right {
            text-align: right;
        }
        .bg-red {
            background-color: #f2dede;
            color: #a94442;
        }
        .bg-green {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .bg-red td,
        .bg-green td {
            color: #fff !important;
        }
        h1 {
            font-size: 28px;
            margin: 0;
        }
        .headline {
            margin: 50px 0 40px;
            text-align: center;
        }
        *::after, *::before {
            box-sizing: border-box;
        }
        .row::after, .row::before {
            content: " ";
            display: table;
        }
        .row::after {
            clear: both;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-left: -15px;
            margin-right: -15px;
        }
        .row > .col-4 {
            width: calc(33.3333% - 30px);
        }
        .row > .col-6 {
            width: calc(50% - 30px);
        }
        [class*='col-'] {
            min-height: 1px;
            padding-left: 15px;
            padding-right: 15px;
            position: relative;
            float: left;
        }
        [class*="col-"] input {
            min-width: 1px;
            width: 100%;
        }
        .col-12 {
            width: 100%;
        }
        .col-3 {
            width: 25%;
        }
        .col-4 {
            width: 33.3333%;
        }
        .col-6 {
            width: 50%;
        }
        .col-2 {
            width: 14.14%;
        }
        .alert {
            border: 1px solid transparent;
            border-radius: 4px;
            margin-bottom: 20px;
            padding: 15px;
        }
        .alert-success {
            background-color: #dff0d8;
            border-color: #d6e9c6;
            color: #3c763d;
        }
        .alert-info {
            background-color: #d9edf7;
            border-color: #bce8f1;
            color: #31708f;
        }
        .alert-warning {
            background-color: #fcf8e3;
            border-color: #faebcc;
            color: #8a6d3b;
        }
        .alert-danger {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }
        .center table {
            width: 100%;
        }
    </style>
</head>
<?php
/**
 * get_current_mysql_version
 * It return the current Installed MySQL version.
 *
 * @return string
 */
function get_current_mysql_version(){
    $output = shell_exec( 'mysql -V' );
    preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version);
    return $version[0];
}

/**
 * check_email
 * Check whether server can send Email or not.
 *
 * @param [string] $toEmailAddress
 * @return bool
 */
function check_email( $toEmailAddress ) {
    $emailSubject = 'NS Test Server Email';
    $emailText = 'Hello, Yes the E-mail is working properly on this server. Enjoy!!!';
    return mail($toEmailAddress, $emailSubject, $emailText);
}

/**
 * show_message
 * Show Bootstrap different messages.
 *
 * @param [string] $msg
 * @param [string] $msgType
 * @return string
 */
function show_message ( $msg, $msgType ) {
    return "<div class='alert ".$msgType."'>".$msg.'</div>';
}

/**
 * get_typo3_version_config
 * get all predefined array with parameters
 *
 * @return array
 */
function get_typo3_version_config () {
    return [
        '9' => [
            'links' => [
                'officialdoc' => [
                    'linktext' => 'Official requirements',
                    'link' => 'https://docs.typo3.org/m/typo3/guide-installation/9.5/en-us/In-depth/SystemRequirements/Index.html'
                ],
            ],
            'requirements' => [
                'php_min' => '7.2',
                'php_max' => '0',
                'sql_min' => '5.0',
                'sql_max' => '5.7.20',
                'ImageMagick' => '6',
                'gd' => '-',
                'mbstring' => '-',
                'max_execution_time' => '240',
                'memory_limit' => '128M',
                'max_input_vars' => '1500',
                'upload_max_filesize' => '100M',
                'post_max_size' => '100M',
                'GraphicsMagick' => '1.3',
            ]
        ],
        '10' => [
            'links' => [
                'officialdoc' => [
                    'linktext' => 'Official requirements',
                    'link' => 'https://docs.typo3.org/m/typo3/guide-installation/10.4/en-us/In-depth/SystemRequirements/Index.html'
                ],
            ],
            'requirements' => [
                'php_min' => '7.2',
                'php_max' => '0',
                'sql_min' => '5.7',
                'sql_max' => '8.1',
                'ImageMagick' => '6',
                'gd' => '-',
                'mbstring' => '-',
                'max_execution_time' => '240',
                'memory_limit' => '256M',
                'max_input_vars' => '1500',
                'upload_max_filesize' => '100M',
                'post_max_size' => '100M',
                'GraphicsMagick' => '1.3',
            ]
        ],
    ];
}
?>
<body>
    <div class="wrapper">
        <div class="headline">
            <h1>Check Server Configuration</h1>
        </div>
        <div class="form-wrapper">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
                <label>Select TYPO3 Version:</label>
                <select name="version" id="typo3-version" required onchange="this.form.submit()">
                    <option value="">Select</option>
                    <?php
                        $TYPO3Version = ['9' => 'TYPO3 9.X', '10' => 'TYPO3 10.X'];
                        foreach ($TYPO3Version as $key => $value) {
                            $VersionSelected = ( isset($_GET['version']) && $_GET['version'] == $key) ? 'selected=selected' : '';
                            echo '<option value='.$key.' '.$VersionSelected.'>'.$value.'</option>';
                        }
                    ?>
                </select>
                <!--<input name="server_config_test" value="Go" type="submit">-->
            </form>
        </div>

        <div class="infor-table-wrapper">
            <?php
            if (isset($_GET['version'])) {
                $selected_val = $_GET['version'];
                echo show_message ( 'You have selected: <b>TYPO3 ' . $selected_val . '.X </b>', 'alert-success');
            ?>
                <table>
                    <thead>
                        <tr>
                            <th width="20%">Modules</th>
                            <th width="8%" class="text-center">Installed (Yes/No)</th>
                            <th width="8%" class="text-center">Current Version</th>
                            <th width="8%" class="text-center">Required Version</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $VersionInfo = get_typo3_version_config();
                        if( isset( $_GET['version']) ) {
                            $value = $VersionInfo[$selected_val];
                            foreach ($value['requirements'] as $module => $module_value) {
                                if( $module_value == '-' ) {
                                    if( $module == 'ImageMagick' ) {
                                        exec('convert -version', $output);
                                        $installed = ($output) ? 'Yes' : 'No';
                                        $color = ($output) ? 'green' : 'red';
                                        $current = '-';
                                    } elseif ( $module =='GraphicsMagick' ) {
                                        exec('gm',$output1);
                                        $installed = ($output1) ? 'Yes' : 'No';
                                        $color = ($output1) ? 'green' : 'red';
                                        if( $output1 ) {
                                            $current = substr($output1['0'], 14, 7);
                                        } else{
                                            $current = 'Not Installed';
                                        }

                                    } else {
                                        $installed = extension_loaded($module) ? 'Yes' : 'No';
                                        $color = extension_loaded($module) ? 'green' : 'red';
                                        $current = '-';
                                    }

                                    $required = '-';
                                    $title = ucwords(str_replace('_',' ',$module));
                                } elseif ( $module =='php_min' ) {
                                    $installed = phpversion() ? 'Yes' : 'No';
                                    $color = (version_compare(PHP_VERSION, $value['php_min']) >= 0) ? 'green' : 'red';
                                    $current = substr(phpversion(), 0, 6);
                                    $required = '>='.$value['php_min'];
                                    $title = 'PHP';
                                    if( $value['php_max'] > 0 ){
                                        if( $color == 'green' ) $color = (version_compare(PHP_VERSION, $value[php_max]) < 0) ? 'green' : 'red';
                                        $highvalue = ' to '.$value['php_max'];
                                        $required = $value['php_min'].$highvalue;
                                    }
                                } elseif ( $module == 'sql_min' ) {
                                    $mysqlcurrent = get_current_mysql_version();
                                    $installed = ($mysqlcurrent > 0) ? 'Yes' : 'No';
                                    $color = (version_compare($mysqlcurrent, $value['sql_min']) >= 0) ? 'green' : 'red';
                                    $current = $mysqlcurrent;
                                    $required = '>='.$value['sql_min'];
                                    $title = 'Mysql';
                                    if( $value['sql_max'] > 0 ) {
                                        if( $color == 'green' ) {
                                            $color = (version_compare($mysqlcurrent, ($value['sql_max']+1)) <= 0) ? 'green' : 'red';
                                        }
                                        $highvalue = ' to '.$value['sql_max'];
                                        $required = $value['sql_min'].$highvalue;

                                    }

                                } elseif ($module === 'ImageMagick') {
                                    $installed = (ini_get($module) > 0) ? 'Yes' : 'No';
                                    if($installed === 'No') {
                                        $installed = extension_loaded($module) ? 'Yes' : 'No';
                                        if($module === 'ImageMagick') {
                                            $installed = extension_loaded('imagick') ? 'Yes' : 'No';
                                            exec('convert -version', $output);
                                            $muster = "/([0-9]{1,4}[.][0-9]{1,4}[.][0-9]{1,4})/";
                                            if(preg_match($muster, $output[0], $matches)) {
                                                $imVersion = explode('.', $matches[0]);
                                                $current = $matches[0];
                                            }
                                            if(rtrim($imVersion[0], 'M') >= rtrim($module_value, 'M')) {
                                                $color = 'green';
                                            } else {
                                                $color = 'red';
                                            }
                                            $required = $module_value;
                                            $title = ucwords(str_replace('_', ' ', $module));
                                        }
                                    }

                                } else {
                                    $installed = (ini_get($module) > 0) ? 'Yes' : 'No';
                                    $current = ini_get($module);
                                    if(rtrim($current, 'M') >= rtrim($module_value, 'M')) {
                                        $color = 'green';
                                    } else {
                                        $color = 'red';
                                    }
                                    $required = $module_value;
                                    $title = ucwords(str_replace('_', ' ', $module));
                                }

                                if( $module !== 'php_max' ) {
                                    if( $module !== 'sql_max' ) {
                                ?>
                                    <tr>
                                        <td><?php echo $title;?></td>
                                        <td class="text-center"><?php echo $installed;?></td>
                                        <td class="text-center bg-<?php echo $color; ?>"><?php echo $current; ?></td>
                                        <td class="text-center bg-<?php echo $color; ?>"><?php echo $required; ?></td>
                                    </tr>
                                <?php
                                    }
                                }
                            }
                        }
                    ?>
                    </tbody>
                </table>
                <div class="hints">
                    <p>Hints:</p>
                    <ul>
                        <li>ImageMagick OR GraphicsMagick is requird.</li>
                        <li>Upload Max Filesize and Post Max Size depends on your needs.</li>
                    </ul>
                </div>
                <div class="links">
                    <p>Links:</p>
                    <ul>
                    <?php
                        if( isset( $_GET['version']) ) {
                            $value = $VersionInfo[$selected_val];
                            foreach ($value['links'] as $link) {
                                echo '<li><a href="'.$link['link'].'">'.$link['linktext'].'</a></li>';
                            }
                        }
                    ?>
                    </ul>
                </div>
                <?php
            }
            ?>
        </div>

        <!-- Starting of Check Database Connection details -->
        <hr />
        <div class="form-wrapper">
            <?php
            if (isset($_POST['check_db_connection']) ) {
                $host = $_POST['host'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $database = $_POST['database'];
                $port = $_POST['port'];

                if (!empty($_POST['port']) ) {
                    $con = mysqli_connect((isset($_POST['host'])) ? $_POST['host'] : 'localhost', $username, $password, $database, $port); // Check the connection is successfull or not.
                } else {
                    $con = mysqli_connect((isset($_POST['host'])) ? $_POST['host'] : 'localhost', $username, $password, $database); // Check the connection is successfull or not.
                }

                echo $DBConnectionMsg = ($con) ? show_message('Database Connection is successful', 'alert-success') : show_message( "Error: Connection can not be done. Please check your credentials again", "alert-danger");
            }
            ?>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" name="form_DB_connection">
                <label>Database Connection details:</label>
                <div class="row">
                    <div class="col-2">
                        <input type="text" name="host" placeholder="Host" value="<?php echo $host = (isset($_POST['host'])) ? $_POST['host'] : '';?>"  />
                    </div>
                    <div class="col-2">
                        <input type="text" required name="username" placeholder="User name" value="<?php echo $DBuserName = (isset($_POST['username'])) ? $_POST['username'] : '';?>" />
                    </div>
                    <div class="col-2">
                        <input type="text" required name="password" placeholder="Password" value="<?php echo $DBPassWord = (isset($_POST['password'])) ? $_POST['password'] : '';?>"/>
                    </div>
                    <div class="col-2">
                        <input type="text" required name="database" placeholder="Database Name" value="<?php echo $DBName = (isset($_POST['database'])) ? $_POST['database'] : '';?>"/>
                    </div>
                    <div class="col-2">
                        <input type="number" name="port" placeholder="Port" value="<?php echo $port = (isset($_POST['port'])) ? $_POST['port'] : '';?>"/>
                    </div>
                    <div class="col-2">
                        <input type="submit" name="check_db_connection" value="Test" />
                    </div>
                </div>
            </form>
        </div>
        <!-- Ending of Check Database Connection details -->

        <!-- Starging of Check the Email functionality -->
        <hr />
        <div class="form-wrapper">
            <?php
            if ( isset( $_POST['check_email_button'] ) ) { // Check if the Check Email function is submitted or not.
                $mail = new Email($_POST['emailserver'], $_POST['emailport']);
                if($_POST['emailsecurity'] == 'tls') {
                    $mail->setProtocol(Email::TLS);
                }
                if($_POST['emailsecurity'] == 'ssl') {
                    $mail->setProtocol(Email::SSL);
                }
                $mail->setLogin($_POST['emailuser'], $_POST['emailpassword']);
                $mail->addTo($_POST['emailTo'], 'Example Receiver');
                $mail->setFrom($_POST['email'], 'Example Sender');
                $mail->setSubject('Example subject');
                $mail->setHtmlMessage('<b>Example message</b>...');

                if($mail->send()){
                    show_message('Email sent successfully. Please check your inbox', 'alert-success');
                } else {
                    echo show_message('Error: Email not sent. Please check your Email configuration.', 'alert-danger');
                }
            }
            ?>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" name="check_email">
                <label>Check Email:</label>
                <div class="row">
                    <div class="form-element col-6">
                        <label for="emailto">Enter the E-mail address you want to be sent to</label>
                        <input id="emailto" type="email" name="emailTo" placeholder="" />
                    </div>
                    <div class="form-element col-6">
                        <label for="email">Enter your E-mail address</label>
                        <input id="email" type="email" name="email" placeholder="" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-element col-6">
                        <label for="emailuser">Enter your username / E-mail address</label>
                        <input id="emailuser" type="text" name="emailuser" placeholder="" required />
                    </div>
                    <div class="form-element col-6">
                        <label for="emailpassword">Password</label>
                        <input id="emailpassword" type="password" name="emailpassword" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-element col-4">
                        <label for="emailserver">Enter your outgoing server</label>
                        <input id="emailserver" type="text" name="emailserver" placeholder="e.g. smtp.gmail.com" required value="" />
                    </div>
                    <div class="form-element col-4">
                        <label for="emailport">Server Port (e.g. 587 or 465)</label>
                        <input id="emailport" type="text" name="emailport" placeholder="587" required value="" />
                    </div>
                    <div class="form-element col-4">
                        <label for="emailsecurity">Encryption</label>
                        <select id="emailsecurity" name="emailsecurity" required>
                            <option value="none">None</option>
                            <option value="tls" selected>TLS</option>
                            <option value="ssl">SSL</option>
                        </select>
                    </div>
                </div>
                <input name="check_email_button" value="Send" type="submit">
            </form>
        </div>
        <!-- Ending of Check the Email functionality -->

        <!-- Starging of php info -->
        <hr />
        <div class="form-wrapper">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get" name="check_email">
                <label>Show full server configurations:</label>
                <input name="phpinfo" value="PHP Info" type="submit">
            </form>
            <?php
                if ( isset( $_GET['phpinfo'] ) ) { //Check if the Check Email function is submitted or not.
                    phpinfo();
                }
            ?>
        </div>
        <!-- Ending of php info -->

        <!-- Delete this file -->
        <hr />
        <div class="form-wrapper">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get" name="delete_this">
                <input name="phpinfo" value="Delete this file!" type="submit">
            </form>
            <?php
                if ( isset( $_GET['delete_this'] ) ) {
                    unlink($_SERVER['PHP_SELF']);
                }
            ?>
        </div>
        <!-- Delete this file -->
    </div>
</body>
</html>

<?php

// namespace Snipworks\Smtp;

/**
 * Send email class using SMTP Authentication
 *
 * @class Email
 * @package Snipworks\SMTP
 * from: https://github.com/snipworks/php-smtp
 */
class Email
{
    const CRLF = "\r\n";
    const TLS = 'tcp';
    const SSL = 'ssl';
    const OK = 250;

    /** @var string $server */
    protected $server;

    /** @var string $hostname */
    protected $hostname;

    /** @var int $port */
    protected $port;

    /** @var resource $socket */
    protected $socket;

    /** @var string $username */
    protected $username;

    /** @var string $password */
    protected $password;

    /** @var int $connectionTimeout */
    protected $connectionTimeout;

    /** @var int $responseTimeout */
    protected $responseTimeout;

    /** @var string $subject */
    protected $subject;

    /** @var array $to */
    protected $to = array();

    /** @var array $cc */
    protected $cc = array();

    /** @var array $bcc */
    protected $bcc = array();

    /** @var array $from */
    protected $from = array();

    /** @var array $replyTo */
    protected $replyTo = array();

    /** @var array $attachments */
    protected $attachments = array();

    /** @var string|null $protocol */
    protected $protocol = null;

    /** @var string|null $textMessage */
    protected $textMessage = null;

    /** @var string|null $htmlMessage */
    protected $htmlMessage = null;

    /** @var bool $isHTML */
    protected $isHTML = false;

    /** @var bool $isTLS */
    protected $isTLS = false;

    /** @var array $logs */
    protected $logs = array();

    /** @var string $charset */
    protected $charset = 'utf-8';

    /** @var array $headers */
    protected $headers = array();

    /**
     * Class constructor
     *  -- Set server name, port and timeout values
     *
     * @param string $server
     * @param int $port
     * @param int $connectionTimeout
     * @param int $responseTimeout
     * @param string|null $hostname
     */
    public function __construct($server, $port = 25, $connectionTimeout = 30, $responseTimeout = 8, $hostname = null)
    {
        $this->port = $port;
        $this->server = $server;
        $this->connectionTimeout = $connectionTimeout;
        $this->responseTimeout = $responseTimeout;
        $this->hostname = empty($hostname) ? gethostname() : $hostname;
        $this->setHeader('X-Mailer', 'PHP/' . phpversion());
        $this->setHeader('MIME-Version', '1.0');
    }

    /**
     * @param string $key
     * @param mixed|null $value
     * @return Email
     */
    public function setHeader($key, $value = null)
    {
        $this->headers[$key] = $value;

        return $this;
    }

    /**
     * Add to recipient email address
     *
     * @param string $address
     * @param string|null $name
     * @return Email
     */
    public function addTo($address, $name = null)
    {
        $this->to[] = array($address, $name);

        return $this;
    }

    /**
     * Add carbon copy email address
     *
     * @param string $address
     * @param string|null $name
     * @return Email
     */
    public function addCc($address, $name = null)
    {
        $this->cc[] = array($address, $name);

        return $this;
    }

    /**
     * Add blind carbon copy email address
     *
     * @param string $address
     * @param string|null $name
     * @return Email
     */
    public function addBcc($address, $name = null)
    {
        $this->bcc[] = array($address, $name);

        return $this;
    }

    /**
     * Add email reply to address
     *
     * @param string $address
     * @param string|null $name
     * @return Email
     */
    public function addReplyTo($address, $name = null)
    {
        $this->replyTo[] = array($address, $name);

        return $this;
    }

    /**
     * Add file attachment
     *
     * @param string $attachment
     * @return Email
     */
    public function addAttachment($attachment)
    {
        if (file_exists($attachment)) {
            $this->attachments[] = $attachment;
        }

        return $this;
    }

    /**
     * Set SMTP Login authentication
     *
     * @param string $username
     * @param string $password
     * @return Email
     */
    public function setLogin($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

        return $this;
    }

    /**
     * Get message character set
     *
     * @param string $charset
     * @return Email
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;

        return $this;
    }

    /**
     * Set SMTP Server protocol
     * -- default value is null (no secure protocol)
     *
     * @param string $protocol
     * @return Email
     */
    public function setProtocol($protocol = null)
    {
        if ($protocol === self::TLS) {
            $this->isTLS = true;
        }

        $this->protocol = $protocol;

        return $this;
    }

    /**
     * Set from email address and/or name
     *
     * @param string $address
     * @param string|null $name
     * @return Email
     */
    public function setFrom($address, $name = null)
    {
        $this->from = array($address, $name);

        return $this;
    }

    /**
     * Set email subject string
     *
     * @param string $subject
     * @return Email
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Set plain text message body
     *
     * @param string $message
     * @return Email
     */
    public function setTextMessage($message)
    {
        $this->textMessage = $message;

        return $this;
    }

    /**
     * Set html message body
     *
     * @param string $message
     * @return Email
     */
    public function setHtmlMessage($message)
    {
        $this->htmlMessage = $message;

        return $this;
    }

    /**
     * Get log array
     * -- contains commands and responses from SMTP server
     *
     * @return array
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * Send email to recipient via mail server
     *
     * @return bool
     */
    public function send()
    {
        $message = null;
        $this->socket = fsockopen(
            $this->getServer(),
            $this->port,
            $errorNumber,
            $errorMessage,
            $this->connectionTimeout
        );

        if (empty($this->socket)) {
            return false;
        }

        $this->logs['CONNECTION'] = $this->getResponse();
        $this->logs['HELLO'][1] = $this->sendCommand('EHLO ' . $this->hostname);

        if ($this->isTLS) {
            $this->logs['STARTTLS'] = $this->sendCommand('STARTTLS');
            stream_socket_enable_crypto($this->socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            $this->logs['HELLO'][2] = $this->sendCommand('EHLO ' . $this->hostname);
        }

        $this->logs['AUTH'] = $this->sendCommand('AUTH LOGIN');
        $this->logs['USERNAME'] = $this->sendCommand(base64_encode($this->username));
        $this->logs['PASSWORD'] = $this->sendCommand(base64_encode($this->password));
        $this->logs['MAIL_FROM'] = $this->sendCommand('MAIL FROM: <' . $this->from[0] . '>');

        $recipients = array_merge($this->to, $this->cc, $this->bcc);
        foreach ($recipients as $address) {
            $this->logs['RECIPIENTS'][] = $this->sendCommand('RCPT TO: <' . $address[0] . '>');
        }

        $this->setHeader('Date', date('r'));
        $this->setHeader('Subject', $this->subject);
        $this->setHeader('From', $this->formatAddress($this->from));
        $this->setHeader('Return-Path', $this->formatAddress($this->from));
        $this->setHeader('To', $this->formatAddressList($this->to));

        if (!empty($this->replyTo)) {
            $this->setHeader('Reply-To', $this->formatAddressList($this->replyTo));
        }

        if (!empty($this->cc)) {
            $this->setHeader('Cc', $this->formatAddressList($this->cc));
        }

        if (!empty($this->bcc)) {
            $this->setHeader('Bcc', $this->formatAddressList($this->bcc));
        }

        $boundary = md5(uniqid(microtime(true), true));
        $this->setHeader('Content-Type', 'multipart/mixed; boundary="mixed-' . $boundary . '"');

        if (!empty($this->attachments)) {
            $this->headers['Content-Type'] = 'multipart/mixed; boundary="mixed-' . $boundary . '"';
            $message .= '--mixed-' . $boundary . self::CRLF;
            $message .= 'Content-Type: multipart/alternative; boundary="alt-' . $boundary . '"' . self::CRLF . self::CRLF;
        } else {
            $this->headers['Content-Type'] = 'multipart/alternative; boundary="alt-' . $boundary . '"';
        }

        if (!empty($this->textMessage)) {
            $message .= '--alt-' . $boundary . self::CRLF;
            $message .= 'Content-Type: text/plain; charset=' . $this->charset . self::CRLF;
            $message .= 'Content-Transfer-Encoding: base64' . self::CRLF . self::CRLF;
            $message .= chunk_split(base64_encode($this->textMessage)) . self::CRLF;
        }

        if (!empty($this->htmlMessage)) {
            $message .= '--alt-' . $boundary . self::CRLF;
            $message .= 'Content-Type: text/html; charset=' . $this->charset . self::CRLF;
            $message .= 'Content-Transfer-Encoding: base64' . self::CRLF . self::CRLF;
            $message .= chunk_split(base64_encode($this->htmlMessage)) . self::CRLF;
        }

        $message .= '--alt-' . $boundary . '--' . self::CRLF . self::CRLF;

        if (!empty($this->attachments)) {
            foreach ($this->attachments as $attachment) {
                $filename = pathinfo($attachment, PATHINFO_BASENAME);
                $contents = file_get_contents($attachment);
                $type = mime_content_type($attachment);
                if (!$type) {
                    $type = 'application/octet-stream';
                }

                $message .= '--mixed-' . $boundary . self::CRLF;
                $message .= 'Content-Type: ' . $type . '; name="' . $filename . '"' . self::CRLF;
                $message .= 'Content-Disposition: attachment; filename="' . $filename . '"' . self::CRLF;
                $message .= 'Content-Transfer-Encoding: base64' . self::CRLF . self::CRLF;
                $message .= chunk_split(base64_encode($contents)) . self::CRLF;
            }

            $message .= '--mixed-' . $boundary . '--';
        }

        $headers = '';
        foreach ($this->headers as $k => $v) {
            $headers .= $k . ': ' . $v . self::CRLF;
        }

        $this->logs['MESSAGE'] = $message;
        $this->logs['HEADERS'] = $headers;
        $this->logs['DATA'][1] = $this->sendCommand('DATA');
        $this->logs['DATA'][2] = $this->sendCommand($headers . self::CRLF . $message . self::CRLF . '.');
        $this->logs['QUIT'] = $this->sendCommand('QUIT');
        fclose($this->socket);

        return substr($this->logs['DATA'][2], 0, 3) == self::OK;
    }

    /**
     * Get server url
     * -- if set SMTP protocol then prepend it to server
     *
     * @return string
     */
    protected function getServer()
    {
        return ($this->protocol) ? $this->protocol . '://' . $this->server : $this->server;
    }

    /**
     * Get Mail Server response
     * @return string
     */
    protected function getResponse()
    {
        $response = '';
        stream_set_timeout($this->socket, $this->responseTimeout);
        while (($line = fgets($this->socket, 515)) !== false) {
            $response .= trim($line) . "\n";
            if (substr($line, 3, 1) == ' ') {
                break;
            }
        }

        return trim($response);
    }

    /**
     * Send command to mail server
     *
     * @param string $command
     * @return string
     */
    protected function sendCommand($command)
    {
        fputs($this->socket, $command . self::CRLF);

        return $this->getResponse();
    }

    /**
     * Format email address (with name)
     *
     * @param array $address
     * @return string
     */
    protected function formatAddress($address)
    {
        return (empty($address[1])) ? $address[0] : '"' . addslashes($address[1]) . '" <' . $address[0] . '>';
    }

    /**
     * Format email address to list
     *
     * @param array $addresses
     * @return string
     */
    protected function formatAddressList(array $addresses)
    {
        $data = array();
        foreach ($addresses as $address) {
            $data[] = $this->formatAddress($address);
        }

        return implode(', ', $data);
    }
}

?>
