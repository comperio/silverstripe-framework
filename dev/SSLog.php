<?php
/**
 * Wrapper class for a logging handler like {@link Zend_Log}
 * which takes a message (or a map of context variables) and
 * sends it to one or more {@link Zend_Log_Writer_Abstract}
 * subclasses for output.
 * 
 * These priorities are currently supported:
 *  - SSLog::ERR
 *  - SSLog::WARN
 *  - SSLog::NOTICE
 * 
 * You can add an error writer by calling {@link SSLog::add_writer()}
 * 
 * Example usage of logging errors by email notification:
 * <code>
 * $logEmailWriter = new SSErrorEmailWriter('my@email.com');
 * SSLog::add_writer($logEmailWriter, SSLog::ERR);
 * </code>
 * 
 * Example usage of logging errors by file:
 * <code>
 *	$logFileWriter = new SSLogFileWriter('/var/log/silverstripe/errors.log');
 *	SSLog::add_writer($logFileWriter, SSLog::ERR);
 * </code>
 *
 * Each writer object can be assigned a formatter. The formatter is
 * responsible for formatting the message before giving it to the writer.
 * {@link SSLogErrorEmailFormatter} is such an example that formats errors
 * into HTML for human readability in an email client.
 * 
 * Formatters are added to writers like this:
 * <code>
 * $logEmailWriter = new SSErrorEmailWriter('my@email.com');
 * $myEmailFormatter = new MyLogEmailFormatter();
 * $logEmailWriter->setFormatter($myEmailFormatter);
 * </code>
 * 
 * @package sapphire
 * @subpackage dev
 */

require_once 'Zend/Log.php';

class SSLog {

	const ERR = Zend_Log::ERR;
	const WARN = Zend_Log::WARN;
	const NOTICE = Zend_Log::NOTICE;

	/**
	 * Logger class to use.
	 * @see SSLog::get_logger()
	 * @var string
	 */
	public static $logger_class = 'SSZendLog';

	/**
	 * @see SSLog::get_logger()
	 * @var object
	 */
	protected static $logger;

	/**
	 * Get the logger currently in use, or create a new
	 * one if it doesn't exist.
	 * 
	 * @return object
	 */
	public static function get_logger() {
		if(!self::$logger) {
			self::$logger = new self::$logger_class;
		}
		return self::$logger;
	}

	/**
	 * Get all writers in use by the logger.
	 * @return array Collection of Zend_Log_Writer_Abstract instances
	 */
	public static function get_writers() {
		return self::get_logger()->getWriters();
	}

	/**
	 * Remove all writers currently in use.
	 */
	public static function clear_writers() {
		self::get_logger()->clearWriters();
	}

	/**
	 * Remove a writer instance from the logger.
	 * @param object $writer Zend_Log_Writer_Abstract instance
	 */
	public static function remove_writer($writer) {
		self::get_logger()->removeWriter($writer);
	}

	/**
	 * Add a writer instance to the logger.
	 * @param object $writer Zend_Log_Writer_Abstract instance
	 * @param const $priority Priority. Possible values: SSLog::ERR or SSLog::WARN
	 */
	public static function add_writer($writer, $priority = null) {
		if($priority) $writer->addFilter(new Zend_Log_Filter_Priority($priority, '='));
		self::get_logger()->addWriter($writer);
	}

	/**
	 * Dispatch a message by priority level.
	 * 
	 * The message parameter can be either a string (a simple error
	 * message), or an array of variables. The latter is useful for passing
	 * along a list of debug information for the writer to handle, such as
	 * error code, error line, error context (backtrace).
	 * 
	 * @param string|array $message String of error message, or array of variables
	 * @param const $priority Priority. Possible values: SSLog::ERR or SSLog::WARN
	 */
	public static function log($message, $priority) {
		try {
			self::get_logger()->log($message, $priority);
		} catch(Exception $e) {
			// @todo How do we handle exceptions thrown from Zend_Log?
			// For example, an exception is thrown if no writers are added
		}
	}

}