<?php
/**
 * Extensions to Zend_Log to make it work nicer
 * with {@link SSLog}.
 * 
 * Please refer to {@link SSLog} for information on
 * setting up logging for your projects.
 * 
 * @package sapphire
 * @subpackage dev
 */

require_once 'Zend/Log.php';

class SSZendLog extends Zend_Log {

	/**
	 * Get all writers in this logger.
	 * @return array of Zend_Log_Writer_Abstract instances
	 */
	public function getWriters() {
		return $this->_writers;
	}

	/**
	 * Remove a writer instance that exists in this logger.
	 * @param object Zend_Log_Writer_Abstract instance
	 */
	public function removeWriter($writer) {
		foreach($this->_writers as $index => $existingWriter) {
			if($existingWriter == $writer) {
				unset($this->_writers[$index]);
			}
		}
	}

	/**
	 * Clear all writers in this logger.
	 */
	public function clearWriters() {
		$this->_writers = array();
	}

}