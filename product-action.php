<?php
if(!empty($_GET["action"])) 
{
$productId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '';

switch($_GET["action"])
 {
	case "add":
		if(!empty($quantity)) {
			$stmt = $db->prepare("SELECT * FROM product where d_id= ?");
			$stmt->bind_param('i',$productId);
			$stmt->execute();
			$productDetails = $stmt->get_result()->fetch_object();
			$itemArray = array(
				'title' => $productDetails->title,
				'd_id' => $productDetails->d_id,
				'quantity' => $quantity,
				'price' => $productDetails->price
			);
			if(!empty($_SESSION["cart_item"])) {
				$found = false;
				foreach($_SESSION["cart_item"] as $k => $v) {
					if($v['d_id'] == $productDetails->d_id) {
						$found = true;
						$_SESSION["cart_item"][$k]['quantity'] += $quantity;
						break;
					}
				}
				if(!$found) {
					$_SESSION["cart_item"][] = $itemArray;
				}
			} else {
				$_SESSION["cart_item"][] = $itemArray;
			}
		}
		break;
	
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
				if($v['d_id'] == $productId) {
					if($v['quantity'] > 1) {
						$_SESSION["cart_item"][$k]['quantity'] -= 1;
					} else {
						unset($_SESSION["cart_item"][$k]);
					}
					break;
				}
			}
		}
		break;
	}
}