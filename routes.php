<?php 
	class Front
	{
		public $route;
		public $backing;

		function __construct($r="front")
		{
			$this->route = $r;
			$this->backing = ($r!="front"?"../":"");
		}


		function Header($params){
			$title = isset($params["title"])?$params["title"]:null;
			$section = isset($params["section"])?$params["section"]:null;
			$sections = isset($params["sections"])?$params["sections"]:null;
			$css = isset($params["css"])?$params["css"]:null;
			$js = isset($params["js"])?$params["js"]:null;
			$backing = $this->backing;
			include $this->backing.$this->route."/templates/header.php";
			if ($title!=null)
				include $this->backing.$this->route."/templates/navbar.php";
			return $this;
		}


		function Footer($params = null){
			$js = isset($params['js'])?$params['js']:null;
			$backing = $this->backing;
			include $this->backing.$this->route."/templates/footer.php";
			return $this;
		}


		function View($route,$data=null){
			$r = "";
			$pos = strpos($route, "/");
			if ($pos === false) {
			    $r = $route."/index.php";
			} else {
				if ($route[strlen($route) - 1] == "/") {
					$r = $route."index.php";
				}else{
					$pos2 = strpos($route,".php");
					if ($pos2 === false){
						$r = $route.".php";
					}else{
						$r = $route;
					}
				}
			}
			include $this->backing.$this->route."/".$r;
			return $this;
		}

		function Script($route,$data=null){
			$r = "";
			$pos2 = strpos($route,".php");
			if ($pos2 === false){
				$r = $route.".php";
			}else{
				$r = $route;
			}
			include $this->route."/scripts/".$r;
			return $this;
		}

		function Modal($route,$data=null){
			$r = "";
			$pos2 = strpos($route,".php");
			if ($pos2 === false){
				$r = $route.".php";
			}else{
				$r = $route;
			}
			include $this->backing.$this->route."/modals/".$r;
			return $this;
		}

	}
?>