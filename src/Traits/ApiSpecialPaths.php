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

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _blvt(): self
    {
        $this->path = $this->path."blvt/";

        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _subAccountApi(): self
    {
        $this->path = $this->path."subAccountApi/";

        return $this;
    } 

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _ipRestriction(): self
    {
        $this->path = $this->path."ipRestriction/";

        return $this;
    } 

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _managedHYPHENsubaccount(): self
    {
        $this->path = $this->path."managed-subaccount/";
        
        return $this;
    }
    
    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _order(): self
    {
        $this->path = $this->path."order/";
        
        return $this;
    }
    

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _rateLimit(): self
    {
        $this->path = $this->path."rateLimit/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _isolated(): self
    {
        $this->path = $this->path."isolated/";
        
        return $this;
    } 

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _userDataStream(): self
    {
        $this->path = $this->path."userDataStream/";
        
        return $this;
    } 

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _lending(): self
    {
        $this->path = $this->path."lending/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _daily(): self
    {
        $this->path = $this->path."daily/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _product(): self
    {
        $this->path = $this->path."product/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _token(): self
    {
        $this->path = $this->path."token/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _project(): self
    {
        $this->path = $this->path."project/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _customizedFixed(): self
    {
        $this->path = $this->path."customizedFixed/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _position(): self
    {
        $this->path = $this->path."position/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _union(): self
    {
        $this->path = $this->path."union/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _staking(): self
    {
        $this->path = $this->path."staking/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _mining(): self
    {
        $this->path = $this->path."mining/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _pub(): self
    {
        $this->path = $this->path."pub/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _worker(): self
    {
        $this->path = $this->path."worker/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _payment(): self
    {
        $this->path = $this->path."payment/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _hashHYPHENtransfer(): self
    {
        $this->path = $this->path."hash-transfer/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _details(): self
    {
        $this->path = $this->path."details/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _profit(): self
    {
        $this->path = $this->path."profit/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _statistics(): self
    {
        $this->path = $this->path."statistics/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _user(): self
    {
        $this->path = $this->path."user/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _loan(): self
    {
        $this->path = $this->path."loan/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _borrow(): self
    {
        $this->path = $this->path."borrow/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _repay(): self
    {
        $this->path = $this->path."repay/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _adjustCollateral(): self
    {
        $this->path = $this->path."adjustCollateral/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _algo(): self
    {
        $this->path = $this->path."algo/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _portfolio(): self
    {
        $this->path = $this->path."portfolio/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _subscribe(): self
    {
        $this->path = $this->path."subscribe/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _redeem(): self
    {
        $this->path = $this->path."redeem/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _bswap(): self
    {
        $this->path = $this->path."bswap/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _fiat(): self
    {
        $this->path = $this->path."fiat/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _c2c(): self
    {
        $this->path = $this->path."c2c/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _orderMatch(): self
    {
        $this->path = $this->path."orderMatch/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _pay(): self
    {
        $this->path = $this->path."pay/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _convert(): self
    {
        $this->path = $this->path."convert/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _rebate(): self
    {
        $this->path = $this->path."rebate/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _nft(): self
    {
        $this->path = $this->path."nft/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _history(): self
    {
        $this->path = $this->path."history/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _giftcard(): self
    {
        $this->path = $this->path."giftcard/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _cryptography(): self
    {
        $this->path = $this->path."cryptography/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _data(): self
    {
        $this->path = $this->path."data/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _positionSide(): self
    {
        $this->path = $this->path."positionSide/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _positionMargin(): self
    {
        $this->path = $this->path."positionMargin/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _income(): self
    {
        $this->path = $this->path."income/";
        
        return $this;
    }

    /**    
     *
     * @param string $name
     *
     * @return self
     */
    public function _asyn(): self
    {
        $this->path = $this->path."asyn/";
        
        return $this;
    }

    
    
    
}
