<?php
namespace Ruslone\Laravel\ChunkUpload;

use Ruslone\Laravel\ChunkUpload\Storage\ChunkStorage;

/**
 * Class Chunk
 *
 * @package Ruslone\Laravel\ChunkUpload
 */
class ChunkFile
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var int
     */
    protected $modifiedTime;

    /**
     * The chunk storage
     *
     * @var ChunkStorage
     */
    protected $storage;

    /**
     * Creates the chunk file
     *
     * @param string $path
     * @param int    $modifiedTime
     * @param ChunkStorage      $storage
     */
    public function __construct($path, $modifiedTime, $storage)
    {
        $this->path = $path;
        $this->modifiedTime = $modifiedTime;
        $this->storage = $storage;
    }

    /**
     * @return string relative to the disk
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getModifiedTime()
    {
        return $this->modifiedTime;
    }

    /**
     * Moves the chunk file to given relative path (within the disk)
     *
     * @param string $pathTo
     *
     * @return bool
     */
    public function move($pathTo)
    {
        return $this->storage->disk()->move($this->path, $pathTo);
    }

    /**
     * Delets the chunk file
     * @return bool
     */
    public function delete()
    {
        return $this->storage->disk()->delete($this->path);
    }

    /**
     * The __toString method allows a class to decide how it will react when it is converted to a string.
     *
     * @return string
     * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.tostring
     */
    function __toString()
    {
        return sprintf("ChunkFile %s uploaded at %s", $this->getPath(), date("Y-m-d H:i:s", $this->getModifiedTime()));
    }


}