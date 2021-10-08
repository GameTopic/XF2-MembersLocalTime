<?php

namespace ThemeHouse\MembersLocalTime\XF\Entity;

/**
 * Class User
 * @package ThemeHouse\MembersLocalTime\XF\Entity
 */
class User extends XFCP_User
{
    /**
     * @return int
     */
    public function getLocalTime()
    {
        $visitor = \XF::visitor();

        try {
            $tz = new \DateTimeZone($this->timezone);
        } catch (\Exception $e) {
            $tz = \XF::language()->getTimeZone();
        }

        try {
            $visitorTz = new \DateTimeZone($visitor->timezone);
        } catch (\Exception $e) {
            $visitorTz = \XF::language()->getTimeZone();
        }

        $date = new \DateTime(null, $tz);
        $visitorDate = new \DateTime(null, $visitorTz);
        return $date->getTimestamp() + $date->getOffset() - $visitorDate->getOffset();
    }
}
