<?

namespace SAPb1;

/**
 * Version class can be used to compare one version to another for equality 
 * or newer or older
 */
class B1SVersion
{
    public readonly string $version;
    public readonly int $major;
    public readonly int $minor;
    public readonly int $patch;
    public readonly string $build;

    public const int OLDER = -1;
    public const int EQUAL = 0;
    public const int NEWER = 1;
    public function __construct(string $version)
    {
        $this->version = $version;
        $semantic = explode("-", $version);
        if (count($semantic) >= 2) {
            $this->build = $semantic[1];
        } else {
            $this->build = "";
        }

        $tokens = explode(".", $semantic[0]);
        if (count($tokens) >= 1) {
            $this->major = intval(rtrim(ltrim($tokens[0], ". v0"), " .-"));
        }
        if (count($tokens) >= 2) {
            $this->minor = intval(rtrim(ltrim($tokens[1], ". v0"), " .-"));
        }
        if (count($tokens) >= 3) {
            $this->patch = intval(rtrim(ltrim($tokens[2], ". v0"), " .-"));
        }
    }

    /**
     * Compares if the passed in version is older, equal or newer than this version
     */
    public function compare(B1SVersion $otherVersion): int
    {
        if ($this->major != $otherVersion->major) {
            return $this->major < $otherVersion->major ? B1SVersion::NEWER : B1SVersion::OLDER;
        } else {
            // major versions are equal
            if ($this->minor != $otherVersion->minor) {
                return $this->minor < $otherVersion->minor ? B1SVersion::NEWER : B1SVersion::OLDER;
            } else {
                // minor versions are equal
                if ($this->patch != $otherVersion->patch) {
                    return $this->patch < $otherVersion->patch ? B1SVersion::NEWER : B1SVersion::OLDER;
                } else {
                    // patch versions are equal
                    if ($this->build != "" && $otherVersion->build != "") {
                        throw "Cannot compare different build versions";
                    } elseif ($this->build != "" || $otherVersion->build != "") {
                        return $this->build == "" ? B1SVersion::NEWER : B1SVersion::OLDER;
                    }
                }
            }
        }
        return B1SVersion::EQUAL;
    }

    public function __toString(){
        return $this->version;
    }
}
?>