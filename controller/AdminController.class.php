<?php
class AdminController extends Controller
{
    
    protected $controls = [
        'pages' => 'Page',
        'orders' => 'Order',
        'categories' => 'Category',
        'goods' => 'Good'
    ];

    public $title = 'admin';
    
    public function index($data)
    {
        return ['controls' => $this->controls];
    }

    public function control($data)
    {
        // Сохранение
        $actionId = $this->getActionId($data);
        if ($actionId['action'] === 'save') {
            $fields = [];

            foreach ($_POST as $key => $value) {
                $field = explode('_', $key, 2);
                if ($field[0] == $actionId['id']) {
                    $fields[$field[1]] = $value;
                }
            }
        }

        if ($actionId['action'] === 'create') {
            $fields = [];
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 4) == 'new_') {
                    $fields[str_replace('new_', '', $key)] = $value;
                }
            }
        }

        switch($actionId['action']) {
            case 'create':
                $query = 'INSERT INTO ' . $data['id'] . ' ';
                $keys = [];
                $values = [];
                foreach ($fields as $key => $value) {
                    $keys[] = $key;
                    $values[] = '"' . $value . '"';
                }

                $query .= ' (' . implode(',', $keys) . ') VALUES ( ' . implode(',', $values) . ')';
                SQL::Instance()->Query($query);
                break;
            case 'save':
                $query = 'UPDATE ' . $data['id'] . ' SET ';
                foreach ($fields as $field => $value) {
                    $query .= $field . ' = "' . $value . '",';
                }
                $query = substr($query, 0, -1) . ' WHERE id = :id';

                SQL::Instance()->Query($query, ['id' => $actionId['id']]);
                break;
            case 'delete':
                SQL::Instance()->Query('UPDATE ' . $data['id'] . ' SET status=:status WHERE id = :id', ['id' => $actionId['id'], 'status' => Status::Deleted]);
                break;
        }
        $fields = SQL::Instance()->Select('desc ' . $data['id']);
        $_items = SQL::Instance()->Select('select * from ' . $data['id']);
        $items = [];
        foreach ($_items as $item) {
            $tmp = new $this->controls[$data['id']]($item);
            $items[] = (array)$tmp;
        }

        return ['name' => $data['id'],'fields' => $fields, 'items' => $items];
    }

    protected function getActionId($data)
    {
        foreach ($_POST as $key => $value) {
            if (strpos($key, '__save_') === 0) {
                $id = explode('__save_', $key)[1];
                $action = 'save';
                break;
            }
            if (strpos($key, '__delete_') === 0) {
                $id = explode('__delete_', $key)[1];
                $action = 'delete';
                break;
            }
            if (strpos($key, '__create') === 0) {
                $action = 'create';
                $id = 0;
            }
        }
        return ['id' => $id, 'action' => $action];
    }

    public function orders()
    {

      $order = Order::getAllOrders();
      $status = OrderStatus::getAllOrderStatuses();

      return ['order' =>$order, 'status' =>$status ];
    }

    public function orderId($data)
    {
        $status = OrderStatus::getAllOrderStatuses();
        $order = Order::getOrderId(isset($data['id']) ? $data['id'] : 0);
        $orderedGoods = Order::getOrderedGoods(isset($data['id']) ? $data['id'] : 0);

        return ['order' =>$order, 'status' =>$status, 'orderedGoods' => $orderedGoods];
    }

    public function goods()
    {
      include_once '../model/Admin.class.php';
      $good = Good::getAllGoods();
      $category = Category::getAllSubcategories();
      $collection = Collection::getAllCollections();
      $material = Material::getAllMaterials();

      return ['good' =>$good, 'category' =>$category, 'collection' =>$collection, 'material' =>$material ];
    }

    public function goodId($data)
    {
      include_once '../model/Admin.class.php';
      $goodId = Good::getGoodId(isset($data['id']) ? $data['id'] : 0);
      $category = Category::getAllSubcategories();
      $collection = Collection::getAllCollections();
      $material = Material::getAllMaterials();

      return ['goodId' =>$goodId, 'category' =>$category, 'collection' =>$collection, 'material' =>$material ];
    }
}