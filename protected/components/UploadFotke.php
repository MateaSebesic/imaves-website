<?php
/**
 * Klasa za upload fotografija, u sebi sadrži metode za kopiranje i cropanje fotografije
 */

    class UploadFotke{
        
        public $fotka;
        
        public $sirina_fotke;
        
        public $visina_fotke;
        
        public $omjer;
        
        public $folder;
        
        public $fileTypes = array('jpg','jpeg','gif','png');
        //definiranje širine i visine thumbnaila
        public $mala_sirina = 150;
        public $mala_visina = 100;
        public $mala_omjer = 0;
        
        //definiranje odredišnog foldera
        public function definirajFolder($folder){
            $this->folder = $folder;
        }
        //definiranje željene širine i visine fotke
        public function definirajDimenzije($sirina,$visina){
            $this->sirina_fotke = $sirina;
            $this->visina_fotke = $visina;
            $this->omjer = $visina / $sirina;
        }
        //upload fotke
        public function uploadajFotku($crop = 0){
            if (!empty($_FILES)) {
                $tempFile = $_FILES['fotka']['tmp_name'];
                //kreiranje direktorija
                $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $this->folder;
                if(!is_dir($targetPath))            mkdir($targetPath,0755);
                if(!is_dir($targetPath.'/mala'))    mkdir($targetPath.'/mala',0755);
                if(!is_dir($targetPath.'/velika'))  mkdir($targetPath.'/velika',0755);
                if(!is_dir($targetPath.'/extra'))  mkdir($targetPath.'/extra',0755);
                $targetPath = $targetPath.'/';
                //definiranje naziva fotografije, micanje suvišnih znakova
                $newName = str_replace(array('č','ć','ž','š','đ',' '),array('c','c','z','s','d','_'),  strtolower( trim($_FILES['fotka']['name']) ) );
                //$newName = Design::seoFriendly($newName);
                $rand = mt_rand(1, 1000);
                $newName = $rand."_".preg_replace("/\s+/","_", $newName);
                //kreiranje male i velike fotke
                $targetFile =  str_replace('//','/',$targetPath) . $newName;
                move_uploaded_file($tempFile,$targetFile);
                //kreiranje male fotke
                $this->mala_omjer = $this->mala_visina / $this->mala_sirina;
                $this->kreirajFotku($targetPath, $newName,"/mala",$this->mala_sirina,$this->mala_visina,$this->mala_omjer);
                //kreiranje velike fotke
                
                    copy($targetFile,str_replace('//','/',$targetPath).'extra/'. $newName);
               
                    $this->kreirajFotku($targetPath, $newName,"/velika",$this->sirina_fotke,$this->visina_fotke, $this->omjer);
               
                unlink($targetFile);
                //vraća novo ime kako bi se moglo spremiti u bazu
                return $newName; 
            }
            
        }
        
        //kreiranje fotke
        public function kreirajFotku($folder, $file, $thimbPath, $w, $h, $omjer){
            list($width, $height, $fileType , $attr) = getimagesize($folder.$file);
            unset($attr);
            SWITCH($fileType){
                    case 2:
                    self::CreateJPEG($folder,$file,$thimbPath,$width,$height,$w,$h, $omjer);
                    break;
                    case 1:
                    self::CreateGIF($folder,$file,$thimbPath,$width,$height,$w,$h, $omjer);
                    break;
                    case 3:
                    self::CreatePNG($folder,$file,$thimbPath,$width,$height,$w,$h, $omjer);
                    break;
            }
          
        }
        
        //kreiranje JPEG fotke
        private function CreateJPEG($folder,$file,$thimbPath,$imagewidth,$imageheight,$Wnew,$Hnew, $omjer){
            $im=ImageCreateFromJPEG($folder.$file);		
            $newimage=imagecreatetruecolor(round($Wnew),round($Hnew));
            //Odredivanje dimenzija
            $perfectX = 0;
            $perfectY = 0;
            $mywidth = $imagewidth;
            $myheight = $imageheight;
            //Ako je visina prevelika, odredivanje cropa
            if (($imageheight / $imagewidth) > $omjer){
                for($myheight = $imageheight; $myheight > 0; $myheight--){
                    if (($myheight / $imagewidth) < $omjer){
                        break;
                    }
                }
                $perfectY = round(($imageheight - $myheight)/2);
            }
            //Ako je širina prevelika, odredivanje cropa
            if (($imageheight / $imagewidth) < $omjer){
                for($mywidth = $imagewidth; $mywidth > 0; $mywidth--){
                    if (($imageheight / $mywidth) > $omjer){
                        break;
                    }
                }
            $perfectX = round(($imagewidth - $mywidth)/2);
            }        
            imagecopyresampled($newimage,$im,0,0,$perfectX,$perfectY,$Wnew,$Hnew,$mywidth,$myheight);
            ImageJPEG($newimage,$folder.$thimbPath.'/'.$file,100);
            chmod($folder.$thimbPath,0755);
        }
      
        //kreiranje GIF fotke
        private static function CreateGIF($folder,$file,$thimbPath,$imagewidth,$imageheight,$Wnew,$Hnew, $omjer){
            $im=ImageCreateFromGIF($folder.$file);		
            $newimage=imagecreatetruecolor($Wnew,$Hnew);
            //Odredivanje dimenzija
            $perfectX = 0;
            $perfectY = 0;
            $mywidth = $imagewidth;
            $myheight = $imageheight;
            //Ako je visina prevelika, odredivanje cropa
            if (($imageheight / $imagewidth) > $omjer){
                for($myheight = $imageheight; $myheight > 0; $myheight--){
                    if (($myheight / $imagewidth) < $omjer){
                        break;
                    }
                }
            $perfectY = round(($imageheight - $myheight)/2);
            }
            //Ako je širina prevelika, odredivanje cropa
            if (($imageheight / $imagewidth) < $omjer){
                for($mywidth = $imagewidth; $mywidth > 0; $mywidth--){
                    if (($imageheight / $mywidth) > $omjer){
                        break;
                    }
                }
            $perfectX = round(($imagewidth - $mywidth)/2);
            }        
            imagecopyresampled($newimage,$im,0,0,$perfectX,$perfectY,$Wnew,$Hnew,$mywidth,$myheight);
            ImageGIF($newimage,$folder.$thimbPath.'/'.$file);
            chmod($folder.$thimbPath,0755);
        }
      
        // kreiranje PNG fotke
        private static function CreatePNG($folder,$file,$thimbPath,$imagewidth,$imageheight,$Wnew,$Hnew, $omjer){
            $im=ImageCreateFromPNG($folder.$file);		
            $newimage=imagecreatetruecolor($Wnew,$Hnew);
            //Odredivanje dimenzija
            $perfectX = 0;
            $perfectY = 0;
            $mywidth = $imagewidth;
            $myheight = $imageheight;
            //Ako je visina prevelika, odredivanje cropa
            if (($imageheight / $imagewidth) > $omjer){
                for($myheight = $imageheight; $myheight > 0; $myheight--){
                    if (($myheight / $imagewidth) < $omjer){
                        break;
                    }
                }
            $perfectY = round(($imageheight - $myheight)/2);
            }
            //Ako je irina prevelika, odredivanje cropa
            if (($imageheight / $imagewidth) < $omjer){
                for($mywidth = $imagewidth; $mywidth > 0; $mywidth--){
                    if (($imageheight / $mywidth) > $omjer){
                        break;
                    }
                }
            $perfectX = round(($imagewidth - $mywidth)/2);
            }        
            imagecopyresampled($newimage,$im,0,0,$perfectX,$perfectY,$Wnew,$Hnew,$mywidth,$myheight);
            ImagePNG($newimage,$folder.$thimbPath.'/'.$file,100);
            chmod($folder.$thimbPath,0755);
        }
        
        
        //provjera ekstenzije
        public function provjeriEkstenziju(){
            $ext = end(explode('.', $_FILES['fotka']['name']));
            $ext = strtolower($ext);
            if ($ext == 'jpg' OR $ext == 'jpeg' OR $ext == 'png' OR $ext == 'gif'){
                return true;
            }
            return false;
            
        }
        
        //provjera veličine
        public function provjeriVelicinu($maxVelicina){
            $velicina = $_FILES['fotka']['size'];
            if ($velicina <= $maxVelicina){
                return true;
            }
            return false;
            
        }
      
        
        
    }

?>