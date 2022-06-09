<?php

declare(strict_types=1);

namespace MARTOCH\binance\Traits;

trait ApiSpecialPaths
{
    /**     
     *
     * @param string $name
     *
     * @return self
    */
    public function _ticker(): self
    {
        $this->path = $this->path."ticker/";

        return $this;
    }

    /**     
     *
     * @param string $name
     *
     * @return self
     */
    public function _capital(): self
    {
        $this->path = $this->path."capital/";

        return $this;
    }

    /**     
     *
     * @param string $name
     *
     * @return self
     */
    public function _config(): self
    {
        $this->path = $this->path."config/";

        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _system(): self
    {
        $this->path = $this->path."system/";

        return $this;
    }


    /**     
     *
     * @param string $name
     *
     * @return self
     */
    public function _account(): self
    {
        $this->path = $this->path."account/";

        return $this;
    }

    /**     
     *
     * @param string $name
     *
     * @return self
     */
    public function _asset(): self
    {
        $this->path = $this->path."asset/";

        return $this;
    }

    /**     
     *
     * @param string $name
     *
     * @return self
     */
    public function _withdraw(): self
    {
        $this->path = $this->path."withdraw/";

        return $this;
    }

    /**     
     *
     * @param string $name
     *
     * @return self
     */
    public function _deposit(): self
    {
        $this->path = $this->path."deposit/";

        return $this;
    }

    /**     
     *
     * @param string $name
     *
     * @return self
     */
    public function _subHYPHENaccount(): self
    {
        $this->path = $this->path."sub-account/";

        return $this;
    }

    /**     
     *
     * @param string $name
     *
     * @return self
     */
    public function _sub(): self
    {
        $this->path = $this->path."sub/";

        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _transfer(): self
    {
        $this->path = $this->path."transfer/";

        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _futures(): self
    {
        $this->path = $this->path."futures/";

        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _margin(): self
    {
        $this->path = $this->path."margin/";

        return $this;
    }

    
    
}
