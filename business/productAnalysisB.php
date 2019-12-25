<?php include "./include/lib/simple_html_dom.php" ?>
<?php
$product_name = "iphone x 64gb";
$type = "class";
$rule = "price";
$link = "https://thegioididong.com/dtdd/iphone-x-64gb";
$test = new ProductAnalysisB();

//$test->TrainRule($product_name);
//$return_list = $test->GetRelevantLinks($product_name);
//$test->BuildUpDataset($product_name, $return_list);
//$test->TEST();
// $test->UpdateViewOfProduct(1);
class ProductAnalysisB
{
    private $highview = 5;
    private $google_link = "https://www.google.com/search?q=";

    public function GetRelevantLinks($product_name)
    {
        $search = $this->BuildSearchString($product_name);
        $url = $this->google_link . $search;

        $html = file_get_html($url);
        $return_list = array();
        foreach ($html->find('a') as $element) {
            $A = $product_name;
            $B = $element->plaintext;

            $pos = stripos($B, $A);
            if ($pos !== false) {
                $link = $this->StandarizeLink($element->href);
                if ($link != -1)
                    $return_list["{$B}"] = "{$link}";
            }
        }
        return $return_list;
    }
    public function GetType($type)
    {
        if (stripos($type, 'class') !== false)
            $temp = 1;
        else if (stripos($type, 'ID') !== false)
            $temp = 2;
        else
            $temp = 3;
        return $temp;
    }

    public function CompareClassRule($element, $rule)
    {
        $class = 'Class: ' . $element->class . '<br>';
        if (stripos($class, $rule) !== false) {
            echo $element->tag . '<br>';
            echo $class;
            return 1;
        }
        return 0;
    }

    public function CompareIDRule($element, $rule)
    {
        $id = 'ID: ' . $element->id . '<br>';
        if (stripos($id, $rule) !== false) {

            echo $element->tag . '<br>';
            //echo $all[$i]->outertext.'<br>';   
            echo $id;
            return 1;
        }
        return 0;
    }

    public function CheckRuleMatchLink($link, $type, $rule)
    {
        $html = file_get_html($link);
        //echo $html;

        $all = $html->find("*");
        $matched_num = 0;
        for ($i = 0, $max = count($all); $i < $max; $i++) {
            $temp = $this->GetType($type);

            if ($temp == 1) {
                $matched_num += $this->CompareClassRule($all[$i], $rule);
            } else if ($temp == 2) {
                $matched_num += $this->CompareIDRule($all[$i], $rule);
            } else {
                $matched_num += $this->CompareClassRule($all[$i], $rule);
                $matched_num += $this->CompareIDRule($all[$i], $rule);
            }
            return $matched_num;
        }
    }
    public function GetAllLinks($product_name)
    {
        $PROD = "'" . $product_name . "'";
        $sql = "SELECT * FROM Dataset WHERE product_name = {$PROD}";
        $db = new Database();
        $result = $db->select($sql);
        $return_list = array();
        while ($row = mysqli_fetch_array($result)) {
            $link_ID = $row['link_id'];
            $link_name = $row['link_name'];
            $return_list["{$link_ID}"] = "{$link_name}";
        }
        return $return_list;
    }

    public function TrainRule($product_name)
    {
        $return_list = $this->GetAllLinks($product_name);

        $sql = "SELECT * FROM Rules";
        $db = new Database();
        $result = $db->select($sql);
        while ($row = mysqli_fetch_array($result)) {
            $rule_name = $row['name'];
            $type = $row['class_or_ID'];
            $count = 0;
            foreach ($return_list as $x => $x_value) {
                $num = $this->CheckRuleMatchLink($x_value, $type, $rule_name);
                if ($num > 0) {
                    $count++;
                }
            }
            echo $count;
            $ratio = (float) $count / count($return_list);
            $this->UpdateMatchingRatio($row['rule_id'], $ratio);
        }
    }

    public function UpdateMatchingRatio($rule_id, $ratio)
    {
        $sql = "UPDATE `rules` SET `matching_ratio` ={$ratio} WHERE rule_id={$rule_id}";
        $db = new Database();
        $db->update($sql);
    }

    public function TestLink($link)
    {
        $html = file_get_html($link);
        if ($html == false)
            return -1;
        return 1;
    }

    public function BuildUpDataset($product_name, $return_list)
    {
        foreach ($return_list as $x => $x_value) {
            $test = $this->CheckLinkInDataset($x_value);
            $test1 = $this->TestLink($x_value);
            if ($test == 0 && $test1 == 1) {
                $LINK = "'" . $x_value . "'";
                $PROD = "'" . $product_name . "'";
                $sql = "INSERT INTO `dataset`(`product_name`,`link_name`) VALUES ({$PROD},{$LINK})";
                $db = new Database();
                $db->insert($sql);
            }
        }
    }

    public function CheckLinkInDataset($link)
    {
        $LINK = "'" . $link . "'";
        $sql = "SELECT COUNT(*) as NUM FROM dataset WHERE `link_name`={$LINK}";
        $db = new Database();
        $result = $db->select($sql);
        $row = mysqli_fetch_array($result);
        return $row['NUM'];
    }

    public function FindPrice($link)
    {
        $html = file_get_html($link);
        //$ret = $html->find('.area_price');
        //$test = '.area_price';
        //$test = '.fs-dtprice';
        //$test = '#_price_new436';
        //$test = '.price';
        $test = '.area_price';
        echo $test;
        foreach ($html->find($test) as $element)
            echo $element . '<br>';
    }

    public function StandarizeLink($raw_link)
    {
        $start = stripos($raw_link, "http");
        if ($start !== false) {
            $end = stripos($raw_link, "&");
            $link = substr($raw_link, $start, $end - $start);
            //echo $link . '<br>';
            return $link;
        }
        return -1;
    }

    public function BuildSearchString($search)
    {
        $list = explode(" ", $search);
        $result = "";
        for ($i = 0; $i < count($list) - 1; $i++)
            $result = $result . $list[$i] . "+";
        $result = $result . $list[$i];
        return $result;
    }

    public function GetView($product_id, $from, $to)
    {
        $TO = "'" . $to . "'";
        $FROM = "'" . $from . "'";
        $sql = "SELECT COUNT(*) as NUM FROM product_analysis WHERE product_id={$product_id} AND visited_date>{$FROM} AND visited_date<{$TO}";
        $db = new Database();
        $result = $db->select($sql);
        $row = mysqli_fetch_array($result);
        return $row['NUM'];
    }

    public function UpdateViewOfProduct($product_id)
    {
        $now = "'" . date("Y-m-d H:i:s") . "'";
        $sql = "INSERT INTO `product_analysis`(`product_id`, `visited_date`) VALUES ({$product_id},{$now})";
        $db = new Database();
        $db->insert($sql);
    }

    public function CheckIfHighView($product_id, $from, $to)
    {
        if ($this->GetView($product_id, $from, $to) > $this->highview) {
            return true;
        }
        return false;
    }
}