<?php
class Straightarrow_SlickSlider_Block_SlickSlider extends Mage_Core_Block_Template
{
	public function methodblock() {
		$retour='';
		/* we are doing the query to select all elements of the pfay_test table (thanks to our model test/test and we sort them by id_pfay_test */
		$collection = Mage::getModel('slickslider/slickslider')->getCollection()->setOrder('id','asc');

		/* then, we check the result of the query and with the function getData() */
		foreach($collection as $data) {
			$retour .= $data->getData('name').'<br />';
		}

		//Mage::getSingleton('adminhtml/session')->addSuccess('Cool Ca marche !!');
		return $retour;
	}

	public function getSliders($position) {
		echo 'test';
		if(!$position) { $position = "header"; }
		$sliders = Mage::getModel('slickslider/slickslider')->getCollection();
		$sliders->addFilter('status',1);
		$sliders->addFilter('position',$position);
		$sliders->addFieldToFilter('page', ['_all', Mage::getSingleton('cms/page')->getIdentifier() ]);
		
		$_slider = '';
	    foreach ($sliders as $slider) {


	        $banners = $this->getBanners($slider->getId());


	        $_slider .= '<div class="slickslider-container slickslider-container-'.$slider->getId().'"><div class="slider slickslider-'.$slider->getId().'">';

	        foreach($banners as $key => $banner) {
	        	$color_style=isset($banner['color_style']) ?$banner['color_style'] : 'none';
	        	$style_open = '<div class="style_'.$color_style.'">';
	        	$style_close = '</div>';

		        $_slider .= '
					<div>
						<div class="sac_slider_banner"><img src="'.$banner['image'].'" /></div>
						<div class="sac_slider_content">
							<div class="sac_slider_content_inner container">
								<div class="row">
									<div class="col-xs-12">
									'.$style_open.'
									'.$banner['html'].'
									'.$style_close.'
									</div>
								</div>
							</div>
						</div>
					</div>

		        ';	        	
	        }


	        $defualt_params = 'slidesToShow: 1, slidesToScroll: 1,arrows: false, fade: false, dots: false,  autoplay: true, autoplaySpeed: 4000';

	        $_params = ($slider->getParams ? $slider->getParams : $defualt_params );

	        $_slider_nav = [];
	        for($i=1;$i<=count($banners);$i++) {
	        	$_slider_nav[] = '<li><a href="#">'.$i.'</a></li>';
	        }
	        $slider_nav = '<div class="slider_dots_nav slider_dots_nav-'.$slider->getId().'">
	        	<ul>'.join($_slider_nav).'</ul>
	        </div>';


	        $_slider .= '</div>'.$slider_nav.'</div>
				<script type="text/javascript">
					jQuery(document).ready(function($){
						$(".slickslider-'.$slider->getId().'").on("init",function(event, slick) { $(".slider_dots_nav-'.$slider->getId().' li").eq(0).addClass("active"); });
						$(".slickslider-'.$slider->getId().'").on("beforeChange", function(event, slick, currentSlide, nextSlide){ $(".slider_dots_nav-'.$slider->getId().' li").removeClass("active").eq(nextSlide).addClass("active"); });
						$(document).on("click",".slider_dots_nav-'.$slider->getId().' a",function(e){ e.preventDefault(); $(".slickslider-'.$slider->getId().'").slick("slickGoTo",$(this).parent().index()); });
					    $(".slickslider-'.$slider->getId().'").slick({'.$_params.'});
					});
				</script>

	        ';


	        
	    }


	    return $_slider;
	    //var_dump($option);
	}

	public function getBanners($id) {
		if(!$id) { return false; }
		$banners = Mage::getModel('slickslider/banners')->getCollection();
		$banners->addFieldToFilter('id_sac_slider_main', $id );
		$_banners = [];


		foreach($banners as $banner) {
			array_push($_banners, [
				'color_style'	=>	$banner->getColor_style(),
				'html'	=>	$banner->getContents(),
				'image'	=>	Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . '/straightarrow/slickslider/' . Mage::helper('slider/slider')->reImageName($banner->getImage())
			]);
		}
		//var_dump($_banners);
		return $_banners;
	}
/*
	public function getBanners($slider_id) {
		if(!$slider_id) { return; }




		$html = '<div class="slickslider-container">';

		$html .= '				<a href="#" id="nextTest">Test</a>
				<div class="slider single-item">
					<div>
						<div class="sac_slider_banner"><img src="http://kenwheeler.github.io/slick/img/fonz1.png" /></div>
						<div class="sac_slider_content">
							<div class="sac_slider_content_inner container">
								<h2>Test</h2>
								<p>test</p>
								<a href="">test</a>
							</div>
						</div>
					</div>
					<div>
						<div class="sac_slider_banner"><img src="http://kenwheeler.github.io/slick/img/fonz2.png" /></div>
					</div>
					<div>
						<div class="sac_slider_banner"><img src="http://kenwheeler.github.io/slick/img/fonz3.png" /></div>
					</div>
				</div>
				<script type="text/javascript">
					jQuery(document).ready(function($){
					    $(".single-item").slick({
						  slidesToShow: 1,
						  slidesToScroll: 1,
						  arrows: false,
						  fade: true,
						  dots: false
					    });

						$(document).on("click","#nextTest",function(e){
							e.preventDefault();
							$(".single-item").slick("slickNext");
							console.log("test");
						})
					});
				</script>


		';



		$html .= '</div>';




		return $html;

	}
*/
}
?>
