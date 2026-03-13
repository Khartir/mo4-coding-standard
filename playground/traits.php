<?php

declare(strict_types=1);

// Dummy trait definitions for testing
trait AlphaTrait {}
trait BetaTrait {}
trait DeltaTrait {}
trait GammaTrait {}
trait ZebraTrait {}

/**
 * @template T
 */
trait GenericTrait {}

/**
 * @template T
 */
trait AnotherGenericTrait {}

// Case 1: Unsorted traits on consecutive lines
class Case1ConsecutiveLines
{
    use ZebraTrait;
    use AlphaTrait;
    use BetaTrait;
}

// Case 2: Unsorted traits with blank lines between them
class Case2BlankLines
{
    use ZebraTrait;

    use AlphaTrait;

    use BetaTrait;
}

// Case 3: Unsorted traits with doc blocks (PHPStan @use annotations)
class Case3DocBlocks
{
    /** @use GenericTrait<string> */
    use GenericTrait;
    /** @use AnotherGenericTrait<int> */
    use AnotherGenericTrait;
}

// Case 4: Unsorted traits with regular comments
class Case4RegularComments
{
    // Zebra does something
    use ZebraTrait;
    // Alpha does something else
    use AlphaTrait;
}

// Case 5: Mix of everything — wrong order, blank lines, comments, doc blocks
class Case5Mixed
{
    use ZebraTrait;

    /** @use GenericTrait<string> */
    use GenericTrait;
    // Delta handles deltas
    use DeltaTrait;

    /** @use AnotherGenericTrait<int> */
    use AnotherGenericTrait;
    use AlphaTrait;
}

// Case 6: Traits with conflict resolution blocks
class Case6ConflictResolution
{
    use ZebraTrait;
    use AlphaTrait {
        AlphaTrait::someMethod as private;
    }
    use BetaTrait;
}

// Case 7: Already sorted (should produce no errors)
class Case7AlreadySorted
{
    use AlphaTrait;
    use BetaTrait;
    use ZebraTrait;
}

// Case 8: Single trait (should produce no errors)
class Case8SingleTrait
{
    use AlphaTrait;
}
