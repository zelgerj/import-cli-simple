<?php

/**
 * TechDivision\Import\Cli\Configuration\Subject
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-cli-simple
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Cli\Configuration;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use TechDivision\Import\ConfigurationInterface;
use TechDivision\Import\Configuration\SubjectInterface;

/**
 * A SLSB that handles the product import process.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-cli-simple
 * @link      http://www.techdivision.com
 */
class Subject implements SubjectInterface
{

    /**
     * The subject's delimiter character for CSV files.
     *
     * @var string
     * @Type("string")
     */
    protected $delimiter;

    /**
     * The subject's enclosure character for CSV files.
     *
     * @var string
     * @Type("string")
     */
    protected $enclosure;

    /**
     * The subject's escape character for CSV files.
     *
     * @var string
     * @Type("string")
     */
    protected $escape;

    /**
     * The subject's source charset for the CSV file.
     *
     * @var string
     * @Type("string")
     * @SerializedName("from-charset")
     */
    protected $fromCharset;

    /**
     * The subject's target charset for a CSV file.
     *
     * @var string
     * @Type("string")
     * @SerializedName("to-charset")
     */
    protected $toCharset;

    /**
     * The subject's file mode for a CSV target file.
     *
     * @var string
     * @Type("string")
     * @SerializedName("file-mode")
     */
    protected $fileMode;

    /**
     * The flag to signal that the subject has to use the strict mode or not.
     *
     * @var boolean
     * @Type("boolean")
     * @SerializedName("strict-mode")
     */
    protected $strictMode;

    /**
     * The subject's class name.
     *
     * @var string
     * @Type("string")
     * @SerializedName("class-name")
     */
    protected $className;

    /**
     * The subject's processor type to use.
     *
     * @var string
     * @Type("string")
     * @SerializedName("processor-factory")
     */
    protected $processorFactory;

    /**
     * The subject's utility class with the SQL statements to use.
     *
     * @var string
     * @Type("string")
     * @SerializedName("utility-class-name")
     */
    protected $utilityClassName;

    /**
     * The file prefix for import files.
     *
     * @var string
     * @Type("string")
     */
    protected $prefix = 'magento-import';

    /**
     * The source date format to use in the subject.
     *
     * @var string
     * @Type("string")
     * @SerializedName("source-date-format")
     */
    protected $sourceDateFormat = 'n/d/y, g:i A';

    /**
     * The source directory that has to be watched for new files.
     *
     * @var string
     * @Type("string")
     * @SerializedName("source-dir")
     */
    protected $sourceDir;

    /**
     * The target directory with the files to be imported.
     *
     * @var string
     * @Type("string")
     * @SerializedName("target-dir")
     */
    protected $targetDir;

    /**
     * The array with the subject's observers.
     *
     * @var array
     * @Type("array")
     */
    protected $observers = array();

    /**
     * The array with the subject's callbacks.
     *
     * @var array
     * @Type("array<string, array>")
     */
    protected $callbacks = array();

    /**
     * The array with the subject's params.
     *
     * @var array
     * @Type("array")
     */
    protected $params = array();

    /**
     * A reference to the parent configuration instance.
     *
     * @var \TechDivision\Import\ConfigurationInterface
     */
    protected $configuration;

    /**
     * Return's the delimiter character to use, default value is comma (,).
     *
     * @return string The delimiter character
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * The enclosure character to use, default value is double quotation (").
     *
     * @return string The enclosure character
     */
    public function getEnclosure()
    {
        return $this->enclosure;
    }

    /**
     * The escape character to use, default value is backslash (\).
     *
     * @return string The escape character
     */
    public function getEscape()
    {
        return $this->escape;
    }

    /**
     * The file encoding of the CSV source file, default value is UTF-8.
     *
     * @return string The charset used by the CSV source file
     */
    public function getFromCharset()
    {
        return $this->fromCharset;
    }

    /**
     * The file encoding of the CSV targetfile, default value is UTF-8.
     *
     * @return string The charset used by the CSV target file
     */
    public function getToCharset()
    {
        return $this->toCharset;
    }

    /**
     * The file mode of the CSV target file, either one of write or append, default is write.
     *
     * @return string The file mode of the CSV target file
     */
    public function getFileMode()
    {
        return $this->fileMode;
    }

    /**
     * Queries whether or not strict mode is enabled or not, default is TRUE.
     *
     * @return boolean TRUE if strict mode is enabled, else FALSE
     */
    public function isStrictMode()
    {
        return $this->strictMode;
    }

    /**
     * Return's the subject's class name.
     *
     * @return string The subject's class name
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Return's the subject's processor factory type to use.
     *
     * @return string The subject's processor factory type
     */
    public function getProcessorFactory()
    {
        return $this->processorFactory;
    }

    /**
     * Return's the utility class with the SQL statements to use.
     *
     * @return string The utility class name
     */
    public function getUtilityClassName()
    {
        return $this->utilityClassName;
    }

    /**
     * Return's the array with the params.
     *
     * @return array The params
     */
    public function getParams()
    {
        if (!$params = reset($this->params)) {
            $params = array();
        }
        return $params;
    }

    /**
     * Query whether or not the param with the passed name exists.
     *
     * @param string $name The name of the param to be queried
     *
     * @return boolean TRUE if the requested param exists, else FALSE
     */
    public function hasParam($name)
    {
        return array_key_exists($name, $this->getParams());
    }

    /**
     * Return's the param with the passed name.
     *
     * @param string $name         The name of the param to return
     * @param mixed  $defaultValue The default value if the param doesn't exists
     *
     * @return string The requested param
     * @throws \Exception Is thrown, if the requested param is not available
     */
    public function getParam($name, $defaultValue = null)
    {

        // query whether or not, the param is set
        if (array_key_exists($name, $params = $this->getParams())) {
            return $params[$name];
        }

        // if not, query we query if a default value has been passed
        if ($defaultValue != null) {
            return $defaultValue;
        }

        // throw an exception if neither the param exists or a default value has been passed
        throw new \Exception(sprintf('Requested param %s not available', $name));
    }

    /**
     * Set's the reference to the configuration instance.
     *
     * @param \TechDivision\Import\ConfigurationInterface $configuration The configuration instance
     *
     * @return void
     */
    public function setConfiguration(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Return's the reference to the configuration instance.
     *
     * @return \TechDivision\Import\ConfigurationInterface The configuration instance
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Set's the prefix for the import files.
     *
     * @param string $prefix The prefix
     *
     * @return void
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * Return's the prefix for the import files.
     *
     * @return string The prefix
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Return's the array with the subject's observers.
     *
     * @return array The subject's observers
     */
    public function getObservers()
    {
        return $this->observers;
    }

    /**
     * Return's the array with the subject's callbacks.
     *
     * @return array The subject's callbacks
     */
    public function getCallbacks()
    {
        return $this->callbacks;
    }

    /**
     * Return's the subject's source date format to use.
     *
     * @return string The source date format
     */
    public function getSourceDateFormat()
    {
        return $this->sourceDateFormat;
    }

    /**
     * Set's the subject's source date format to use.
     *
     * @param string $sourceDateFormat The source date format
     *
     * @return void
     */
    public function setSourceDateFormat($sourceDateFormat)
    {
        $this->sourceDateFormat = $sourceDateFormat;
    }

    /**
     * Set's the source directory that has to be watched for new files.
     *
     * @param string $sourceDir The source directory
     *
     * @return void
     */
    public function setSourceDir($sourceDir)
    {
        $this->sourceDir = $sourceDir;
    }

    /**
     * Return's the source directory that has to be watched for new files.
     *
     * @return string The source directory
     */
    public function getSourceDir()
    {
        return $this->sourceDir;
    }

    /**
     * Return's the target directory with the files to be imported.
     *
     * @return string The target directory
     */
    public function getTargetDir()
    {
        return $this->targetDir;
    }

    /**
     * Set's the target directory with the files to be imported.
     *
     * @param string $targetDir The target directory
     *
     * @return void
     */
    public function setTargetDir($targetDir)
    {
        $this->targetDir = $targetDir;
    }
}
