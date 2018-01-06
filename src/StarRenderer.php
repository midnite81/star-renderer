<?php

namespace Midnite81\StarRenderer;

use Midnite81\StarRenderer\Exceptions\StarValueExceedsMaximum;

class StarRenderer
{
    protected $stars;

    protected $fullStar = '<i class="fa fa-star review-star" aria-hidden="true"></i>';

    protected $halfStar = '<i class="fa fa-star-half-o review-star" aria-hidden="true"></i>';

    protected $emptyStar = '<i class="fa fa-star-o review-star" aria-hidden="true"></i>';

    protected $export;

    public function __construct(array $config = [])
    {
        if (! empty($config)) {
            $this->fillAttributes($config);
        }
    }

    /**
     * Render out the stars
     *
     * @param $value
     * @param int $outOf
     * @return mixed
     * @throws StarValueExceedsMaximum
     */
    public function render($value = null, $outOf = 5)
    {
        if ($value == null || $value == '') {
            return $this->noReviews($outOf);
        }

        if ($outOf < $value) {
            throw new StarValueExceedsMaximum('Number of stars cannot exceed total number of stars');
        }

        $this->stars = $value;
        $this->calculate($outOf);
        return $this->export;
    }

    /**
     * Calculate the HTML to output
     *
     * @param $outOf
     * @return string
     */
    protected function calculate($outOf)
    {
        $html = [];

        for($i = 1; $i <= $outOf; $i++) {
            if ($i <= floor($this->stars)) {
                $html[] = $this->fullStar;
            } else if ($i == ceil($this->stars)) {
                $html[] = $this->halfStar;
            } else {
                $html[] = $this->emptyStar;
            }
        }

        $this->export = implode(' ', $html);
    }

    /**
     * @param string $fullStar
     * @return $this
     */
    public function setFullStar($fullStar)
    {
        $this->fullStar = $fullStar;
        return $this;
    }

    /**
     * @param string $halfStar
     * @return $this
     */
    public function setHalfStar($halfStar)
    {
        $this->halfStar = $halfStar;
        return $this;
    }

    /**
     * @param string $emptyStar
     * @return $this
     */
    public function setEmptyStar($emptyStar)
    {
        $this->emptyStar = $emptyStar;
        return $this;
    }

    /**
     * Returns empty stars when no reviews
     *
     * @param int $outOf
     * @return string
     */
    protected function noReviews($outOf = 5)
    {
        $output = [];

        for ($i = 1; $i <= $outOf; $i++) {
            $output[] = $this->emptyStar;
        }

        return implode(' ', $output);
    }

    /**
     * Get full star value
     *
     * @return string
     */
    public function getFullStar()
    {
        return $this->fullStar;
    }

    /**
     * Get Half Star value
     *
     * @return string
     */
    public function getHalfStar()
    {
        return $this->halfStar;
    }

    /**
     * Get Empty Star Value
     *
     * @return string
     */
    public function getEmptyStar()
    {
        return $this->emptyStar;
    }

    /**
     * Fill attributes
     *
     * @param $config
     */
    protected function fillAttributes($config)
    {
        $fillable = ['fullStar', 'halfStar', 'emptyStar'];

        foreach($fillable as $fill) {
            if (!empty($config[$fill])) {
                $this->{$fill} = $config[$fill];
            }
        }
    }
}