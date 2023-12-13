<?php


class Cart extends Controller
{

    function LoadView()
    {
        $cart = $this->view("main", [
            "Page" => "cart"
        ]);
    }

    function createCart($product_id)
    {
        $productModel = $this->model("ProductModel");
        // $id = (int) $_GET['product_id'];
        $id = $product_id;
        $product = $productModel->getProductById($id);

        // show_array($product);
        $qty = 1;

        if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            $qty = $_SESSION['cart']['buy'][$id]['qty'] + 1;
        }

        $_SESSION['cart']['buy'][$id] = array(
            'product_id' => $product['product_id'],
            'product_name' => $product['product_name'],
            'price' => $product['price'],
            'img' => $product['img'],
            'category_id' => $product['category_id'],
            'qty' => $qty,
            'sub_total' => $product['price'] * $qty

        );



        $this->updateInfoCart();
        // show_array($_SESSION['cart']);
        // unset($_SESSION['cart']);
        // redirect("?mod=product");
        echo '<script>alert("Đã thêm sản phẩm vào giỏ hàng");setTimeout(function(){window.location.href="/fast-food/Cart";}, 200);</script>';
    }

    function updateInfoCart()
    {
        if (isset($_SESSION['cart'])) {
            $total_order = 0;
            $total_money = 0;
            foreach ($_SESSION['cart']['buy'] as $item) {
                $total_order += $item['qty'];
                $total_money += $item['sub_total'];
            }

            $_SESSION['cart']['info'] = array(
                'total_order' => $total_order,
                'total_money' => $total_money
            );
        }
    }

    function updateCart()
    {
        $id = $_POST['id'];
        $qty = $_POST['qty'];
        $productModel = $this->model("ProductModel");
        $item = $productModel->getProductById($id);

        if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
            // Cap nhat so luong
            $_SESSION['cart']['buy'][$id]['qty'] = $qty;
            // Cap nhat tong tien

            $sub_total = $qty * $item['price'];
            $_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total;

            // Cap nhat toan bo gio hang
            if (isset($_SESSION['cart'])) {
                $total_order = 0;
                $total_money = 0;
                foreach ($_SESSION['cart']['buy'] as $item) {
                    $total_order += $item['qty'];
                    $total_money += $item['sub_total'];
                }

                $_SESSION['cart']['info'] = array(
                    'total_order' => $total_order,
                    'total_money' => $total_money
                );
            }
            // $total_money = 0;
            // $total_order = 0;
            // Lay tong gia tri trong gio hang
            if (isset($_SESSION['cart']['info'])) {
                $total_money = $_SESSION['cart']['info']['total_money'];
            }

            if (isset($_SESSION['cart']['info'])) {
                $total_order = $_SESSION['cart']['info']['total_order'];
            }
            // Gia tri tar ve
            $data = array(
                // 'sub_total' => currency_format($sub_total),
                'sub_total' => $this->currency_format($sub_total),
                // 'total_money' => currency_format($total_money),s
                'total_money' => $this->currency_format($total_money),
                'total_order' => $total_order,

            );
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }

    function deleteCart($product_id)
    {
        unset($_SESSION['cart']['buy'][$product_id]);
        if (isset($_SESSION['cart'])) {
            $total_order = 0;
            $total_money = 0;
            foreach ($_SESSION['cart']['buy'] as $item) {
                $total_order += $item['qty'];
                $total_money += $item['sub_total'];
            }

            $_SESSION['cart']['info'] = array(
                'total_order' => $total_order,
                'total_money' => $total_money
            );
        }

        $this->redirect("/fast-food/Cart");
    }

    function bill()
    {
        $bill = $this->view("main", [
            'Page' => 'bill'
        ]);
    }

    function createBill()
    {
        $BillModel = $this->model("BillModel");
        $BillModel->create();
    }

    function billDetail($order_id)
    {

        $this->view("main", [
            'Page' => 'billDetail',
            "orderId" => $order_id
        ]);
    }

    function Cancel($order_id)
    {
        $this->view("main", [
            'Page' => 'account'
        ]);
        $BillModel = $this->model('BillModel');
        $BillModel->Cancel($order_id);
    }
}
