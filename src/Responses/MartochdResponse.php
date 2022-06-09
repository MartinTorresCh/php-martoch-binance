<?php

declare(strict_types=1);

namespace MARTOCH\binance\Responses;

use MARTOCH\binance\Traits\Collection;
use MARTOCH\binance\Traits\ImmutableArray;
use MARTOCH\binance\Traits\SerializableContainer;

class MartochdResponse extends Response implements
    \ArrayAccess,
    \Countable,
    \Serializable,
    \JsonSerializable
{
    use Collection;
    use ImmutableArray;
    use SerializableContainer;

    /**
     * Gets array representation of response object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return (array) $this->result();
    }

    /**
     * Gets root container of response object.
     *
     * @return array
     */
    public function toContainer(): array
    {
        return $this->container;
    }
}
