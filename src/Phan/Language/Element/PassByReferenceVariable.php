<?php declare(strict_types=1);
namespace Phan\Language\Element;

use Phan\AST\ContextNode;
use Phan\CodeBase;
use Phan\Debug;
use Phan\Language\Context;
use Phan\Language\FileRef;
use Phan\Language\UnionType;
use ast\Node;

/**
 * This class wraps a parameter and a element and proxies
 * calls to the element but keeps the name of the parameter
 * allowing us to pass a element into a method as a
 * pass-by-reference parameter so that its value can be
 * updated when re-analyzing the method.
 */
class PassByReferenceVariable extends Variable
{

    /** @var Parameter */
    private $parameter;

    /** @var TypedElement */
    private $element;

    public function __construct(
        Parameter $parameter,
        TypedElement $element
    ) {
        $this->parameter = $parameter;
        $this->element = $element;
    }

    public function getName() : string
    {
        return $this->parameter->getName();
    }

    public function getUnionType() : UnionType
    {
        return $this->element->getUnionType();
    }

    public function setUnionType(UnionType $type)
    {
        $this->element->setUnionType($type);
    }

    public function getFlags() : int
    {
        return $this->element->getFlags();
    }

    public function setFlags(int $flags)
    {
        $this->element->setFlags($flags);
    }

    protected function getPhanFlags() : int
    {
        return $this->element->getPhanFlags();
    }

    protected function setPhanFlags(int $phan_flags)
    {
        $this->element->setPhanFlags($phan_flags);
    }

    public function getContext() : Context
    {
        return $this->element->getContext();
    }

    public function getFileRef() : FileRef
    {
        return $this->element->getFileRef();
    }

    public function isDeprecated() : bool
    {
        return $this->element->isDeprecated();
    }

    public function setIsDeprecated(bool $is_deprecated)
    {
        $this->element->setIsDeprecated($is_deprecated);
    }

    public function isInternal() : bool
    {
        return $this->element->isInternal();
    }
}
