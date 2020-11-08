<?php
	class Photoupload{
		private $photoinput;
		private $photofiletype;
		private $mytempimage;
        private $mynewtempimage;
        private $filesizelimit = 2097152;
        private $photouploaddir_orig = "photoupload_orig/";
        private $photouploaddir_normal = "photoupload_normal/";
        private $photouploaddir_thumb = "photoupload_thumb/";
        private $watermark = "IMG/vp_logo_w100_overlay.png";
        private $filenameprefix = "vp_";
        private $filename;
		
		function __construct(/*$photoinput, $filetype*/){
            //$this->photoinput = $photoinput;
            //var_dump($this->photoinput);
            //$this->photofiletype = $filetype;
            //$this->createImageFromFile();
			
		}//construct
		
		function __destruct(){
			imagedestroy($this->mytempimage);
		}
		
		private function createImageFromFile(){
			if($this->photofiletype == "jpg"){
				$this->mytempimage = imagecreatefromjpeg($this->photoinput["tmp_name"]);
			}
			if($this->photofiletype == "png"){
				$this->mytempimage = imagecreatefrompng($this->photoinput["tmp_name"]);
			}
			if($this->photofiletype == "gif"){
				$this->mytempimage = imagecreatefromgif($this->photoinput["tmp_name"]);
			}
        }
        
        public function isImage($file){
            $photoFileTypes = ["image/jpeg", "image/png", "image/gif"];
            $fileInfo = getImagesize($file);
		    if(in_array($fileInfo["mime"], $photoFileTypes)){
                if($check["mime"] == "image/jpeg"){
                    $filetype = "jpg";
                }
                elseif($check["mime"] == "image/png"){
                    $filetype = "png";
                }
                elseif($check["mime"] == "image/gif"){
                    $filetype = "gif";
                }
                return TRUE;
            }
            else{
                return FALSE;
            }
        }

        public function isAllowedSize($file){
            return ($file["size"] > $filesizelimit);
        }

        public function alreadyExists($filename){
            return file_exists($photouploaddir_orig .$filename["name"]);
        }

        public function createName(){
            $timestamp = microtime(1) * 10000;
            $filename = $filenameprefix .$timestamp ."." .$filetype;
            return $filename;
        }
		
		public function resizePhoto($w, $h, $keeporigproportion = true){
			$imagew = imagesx($this->mytempimage);
			$imageh = imagesy($this->mytempimage);
			$neww = $w;
			$newh = $h;
			$cutx = 0;
			$cuty = 0;
			$cutsizew = $imagew;
			$cutsizeh = $imageh;
			
			if($w == $h){
				if($imagew > $imageh){
					$cutsizew = $imageh;
					$cutx = round(($imagew - $cutsizew) / 2);
				} else {
					$cutsizeh = $imagew;
					$cuty = round(($imageh - $cutsizeh) / 2);
				}	
			} elseif($keeporigproportion){//kui tuleb originaaproportsioone säilitada
				if($imagew / $w > $imageh / $h){
					$newh = round($imageh / ($imagew / $w));
				} else {
					$neww = round($imagew / ($imageh / $h));
				}
			} else { //kui on vaja kindlasti etteantud suurust, ehk pisut ka kärpida
				if($imagew / $w < $imageh / $h){
					$cutsizeh = round($imagew / $w * $h);
					$cuty = round(($imageh - $cutsizeh) / 2);
				} else {
					$cutsizew = round($imageh / $h * $w);
					$cutx = round(($imagew - $cutsizew) / 2);
				}
			}
			
			//loome uue ajutise pildiobjekti
			$this->mynewtempimage = imagecreatetruecolor($neww, $newh);
			//kui on läbipaistvusega png pildid, siis on vaja säilitada läbipaistvusega
			imagesavealpha($this->mynewtempimage, true);
			$transcolor = imagecolorallocatealpha($this->mynewtempimage, 0, 0, 0, 127);
			imagefill($this->mynewtempimage, 0, 0, $transcolor);
			imagecopyresampled($this->mynewtempimage, $this->mytempimage, 0, 0, $cutx, $cuty, $neww, $newh, $cutsizew, $cutsizeh);
		}
		
		public function addWatermark($wmfile){
			if(isset($this->mynewtempimage)){
				$watermark = imagecreatefrompng($wmfile);
				$wmw = imagesx($watermark);
				$wmh = imagesy($watermark);
				$wmx = imagesx($this->mynewtempimage) - $wmw - 10;
				$wmy = imagesy($this->mynewtempimage) - $wmh - 10;
				//kopeerime vesimärgi vähendatud pildile
				imagecopy($this->mynewtempimage, $watermark, $wmx, $wmy, 0, 0, $wmw, $wmh);
				imagedestroy($watermark);
			}
		}
		
		public function saveimage($target){
			$notice = null;
			if($this->photofiletype == "jpg"){
				if(imagejpeg($this->mynewtempimage, $target, 90)){
					$notice = 1;
				} else {
					$notice = 0;
				}
			}
			if($this->photofiletype == "png"){
				if(imagepng($this->mynewtempimage, $target, 6)){
					$notice = 1;
				} else {
					$notice = 0;
				}
			}
			if($this->photofiletype == "gif"){
				if(imagegif($this->mynewtempimage, $target)){
					$notice = 1;
				} else {
					$notice = 0;
				}
			}
			imagedestroy($this->mynewtempimage);
			return $notice;
		}
	}//class lõppeb