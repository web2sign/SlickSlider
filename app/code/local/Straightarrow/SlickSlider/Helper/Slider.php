<?php 

class Straightarrow_SlickSlider_Helper_Slider extends Mage_Core_Helper_Abstract {

    public static function uploadImage() {
        $banner_image_path = Mage::getBaseDir('media') . DS . 'straightarrow' . DS . 'slickslider';
        $image = "";
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
            try {
                /* Starting upload */
                $uploader = new Varien_File_Uploader('image');

                // Any extention would work
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                $uploader->setAllowRenameFiles(false);

                $uploader->setFilesDispersion(true);

                $uploader->save($banner_image_path, $_FILES['image']['name']);


            } catch (Exception $e) {
                
            }

            $image = $_FILES['image']['name'];
        }       

        return $image;
    }


    public function deleteImage($image) {
        if (!$image) {
            return;
        }
        $name = $this->reImageName($image);
        $banner_image_path = Mage::getBaseDir('media') . DS . 'straightarrow' . DS . 'slickslider' . DS . $name;
        if (!file_exists($banner_image_path)) {
            return;
        }

        try {
            unlink($banner_image_path);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }



    public function reImageName($imageName) {

        $subname = substr($imageName, 0, 2);
        $array = array();
        $subDir1 = substr($subname, 0, 1);
        $subDir2 = substr($subname, 1, 1);
        $array[0] = $subDir1;
        $array[1] = $subDir2;
        $name = $array[0] . '/' . $array[1] . '/' . $imageName;

        return strtolower($name);
    }
}