<?php
    namespace Dansnet;
    
    class Date {
        
        private static $_formats = [
            "Y-m-d",
            "Y-m-d H:i",
            "Y-m-d H:i:s",
            "d-m-Y",
            "d-m-Y H:i",
            "d-m-Y H:i:s",
            "d.m.Y",
            "d.m.Y H:i",
            "d.m.Y H:i:s"
        ];
        
        private static $_formatDefaultDate = "Y-m-d";
        private static $_formatDefaultTime = "H:i:s";
        private static $_formatDefaultShortTime = "H:i";
        private static $_formatDefaultDateTime = "Y-m-d H:i:s";
        
        private static $_formatDateGerman = "d.m.Y";
        private static $_formatDateInternational = "Y-m-d";
        
        private $_date;
        
        /**
         * Erzeugt ein neues Date Objekt. Als Parameter kan ein DateTime-Objekt,
         * ein String oder Nichts angegeben werden. Im Falle eines Strings wird
         * das Datum automatisch geparst. Falls nicht übergeben wird, wird ein 
         * Objekt mit dem jetzigen Zeitstempel erzeugt.
         * 
         * @param mixed $date
         * @return void 
         */
        public function __construct( $date=NULL ) {
            if( empty($date) ) {
                $this->_date = new \DateTime();
            } else if ( is_a($date, "DateTime") ) {
                $this->_date = $date;
            } else {
                $this->_date = static::parse($date); 
            }

        }

        /**
         * Parst einen String in ein Datum. Die gültigen Formate sind:
         * <ul>
         *  <li>Y-m-d</li>
         *  <li>Y-m-d H:i</li>
         *  <li>Y-m-d H:i:s</li>
         *  <li>d-m-Y</li>
         *  <li>d-m-Y H:i</li>
         *  <li>d-m-Y H:i:s</li>
         *  <li>d.m.Y</li>
         *  <li>d.m.Y H:i</li> 
         *  <li>d.m.Y H:i:s</li>
         * </ul>
         * 
         * @param mixed $date
         * @return DateTime|boolean
         */
        public static function parse( $date ) {
            foreach( static::$_formats as $format ) {
                $parsed = date_create_from_format($format, $date);
                if( $parsed !== FALSE ) {
                    return $parsed;
                }
            }
            return FALSE;
        }
        
        public function getDate( $format="" ) {
            if( empty($format) ) {
                return date_format($this->_date, static::$_formatDefaultDate);
            }
            return date_format($this->_date, $format);
        }
        
        public function getTime() {
            return date_format($this->_date, static::$_formatDefaultTime);
        }
        
        public function getShortTime() {
            return date_format($this->_date, static::$_formatDefaultShortTime);
        }
        
        public function getDateTime() {
            return date_format($this->_date, static::$_formatDefaultDateTime);
        }
        
        public function getDateGerman() {
            return date_format($this->_date, static::$_formatDateGerman);
        }
        
        public function getDateTimeGerman() {
            return date_format($this->_date, $this->concatDateTime(static::$_formatDateGerman, static::$_formatDefaultTime));
        }
        
        public function getDateInternational() {
            return date_format($this->_date, static::$_formatDateInternational);
        }
        
        public function getDateTimeInternational() {
            return date_format($this->_date, $this->concatDateTime(static::$_formatDateInternational, static::$_formatDefaultTime));
        }
        
        public function calculate( $modify ) {
            $newDate = clone $this->_date;
            return $newDate->modify($modify);
        }
        
        public function tomorrow() {
            $newDate = clone $this->_date;
            return $newDate->modify("+1 day");
        }
        
        public function yesterday() {
            $newDate = clone $this->_date;
            return $newDate->modify("-1 day");
        }
        
        private function concatDateTime( $date, $time ) {
            return $date." ".$time;
        }
        
        public function __toString() {
            return $this->getDateTimeInternational();
        }
        
    }
        
