<?php

/**
 * Created by Kiss.
 * User: luis
 * Date: 16/11/2014
 * Time: 05:52 PM
 */
class Grid extends ObjectDB
{

    //***********************************************atr
    private $id;
    private $width;
    private $total = 0; /////total sum
    private $showResults = true;
    private $noResultsMessage = LANG_noRegs;
    private $search = true;
    private $link1 = array(); //array=("url"=>"string", "icon"=>"string", "params"=>"pos..separated '/' ");
    private $link2;
    private $link3;
    private $linkDelete = array(); //array=("icon"=>"string", "params"=>"pos");
    private $maskValue = array(); //array =("pos"=>1,"1"=>"hello","2"=>"bye",...))
    private $dataLink;
    private $dateFormat;
    private $spacing = array(); // array(0 => [int  (%/px)], 1 => "[string]", 3 => [string]...);
    private $align = array(); // array(0 => [string  (left,rigt,center)], 1 => "[string]", 3 => [string]...);
    private $order = array(); // array(0 => "string,int,float,date", 1 => "string,int,float,date",...);
    private $decoration = array(); // array(0 => [string  (capitalize,blink,etc...)],...);
    private $columnNames = array(); // array(0=>"id",1=>"name",2=>"lastname");
    private $nullCell = "";
    private $nullValue;
    private $pagination = 50; ///default
    private $hidden; //"0,1..."
    private $dateValues; //"0,1..."


    /**
     * @param array $align
     */
    public function setAlign($align)
    {
        $this->align = $align;
    }

    /**
     * @param mixed $dataLink
     */
    public function setDataLink($dataLink)
    {
        $this->dataLink = $dataLink;
    }

    /**
     * @param mixed $dateValues
     */
    public function setDateValues($dateValues)
    {
        $this->dateValues = $dateValues;
    }

    /**
     * @param array $decoration
     */
    public function setDecoration($decoration)
    {
        $this->decoration = $decoration;
    }


    /**
     * @param mixed $hidden
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * @param mixed $link1
     */
    public function setLink1($link1)
    {
        $this->link1 = $link1;
    }

    /**
     * @param mixed $link2
     */
    public function setLink2($link2)
    {
        $this->link2 = $link2;
    }

    /**
     * @param mixed $link3
     */
    public function setLink3($link3)
    {
        $this->link3 = $link3;
    }

    /**
     * @param array $linkDelete
     */
    public function setLinkDelete($linkDelete)
    {
        $this->linkDelete = $linkDelete;
    }

    /**
     * @param array $maskValue
     */
    public function setMaskValue($maskValue)
    {
        $this->maskValue = $maskValue;
    }


    /**
     * @param string $nullCell
     */
    public function setNullCell($nullCell)
    {
        $this->nullCell = $nullCell;
    }

    /**
     * @param mixed $nullValue
     */
    public function setNullValue($nullValue)
    {
        $this->nullValue = $nullValue;
    }


    /**
     * @param boolean $search
     */
    public function setSearch($search)
    {
        $this->search = $search;
    }


    /**
     * @param boolean $showResults
     */
    public function setShowResults($showResults)
    {
        $this->showResults = $showResults;
    }

    /**
     * @param int $pagination
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * @param array $spacing
     */
    public function setSpacing($spacing)
    {
        $this->spacing = $spacing;
    }


    /**
     * @param array $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @param array $columnNames
     */
    public function setColumnNames($columnNames)
    {
        $this->columnNames = $columnNames;
    }


    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @param string $noResultsMessage
     */
    public function setNoResultsMessage($noResultsMessage)
    {
        $this->noResultsMessage = $noResultsMessage;
    }


    private function areLinks()
    {

        return count($this->link1) + count($this->link2) + count($this->link3) > 1;

    }

    /**
     * @param mixed $dateFormat
     */
    public function setDateFormat($dateFormat)
    {
        $this->dateFormat = $dateFormat;
    }


    ///construct

    function __construct($id, $width)
    {
        $this->width = $width;
        $this->id = $id;
        ObjectDB::__construct(); ///super
    }


    public function load()
    {

        if ($this->getSql() != "") {
            $this->executeQuery();
            $this->setFieldsVector();
            $this->close();
        } else {
            die("query hasn't been loaded");
        }

    }


    public function show()
    {

        if ($this->getNumRows()) {

            /////search text into grid
            if ($this->search)
                print '<div class="large-2 medium-2 small-1 columns" style="float: left; vertical-align: bottom"><input  type="text" id="kwd_search" value="" placeholder="' . LANG_search . '"/></div>';

            print '<table id="' . $this->id . '" role="grid">';
            print '<thead><tr style="cursor: pointer">';

            foreach ($this->getFields() as $i1 => $field) {

                ///order
                $orderHead = (!$this->order[$i1]) ? 'data-sort="string"' : 'data-sort="' . $this->order[$i1] . '"';
                ///hidden
                $hiddenValues = explode(",", $this->hidden);
                $headHidden = (in_array($i1, $hiddenValues)) ? ';display:none' : '';
                ///column names
                $field = ($this->columnNames[$i1] != "") ? $this->columnNames[$i1] : $field;
                print' <th ' . $orderHead . ' width="' . $this->spacing[$i1] . '" style="text-transform: capitalize; text-align:center; ' . $headHidden . '">' . $field . '</th>';
            }

            ////links (optional)
            if ($this->areLinks())
                print '<th width="7%">&nbsp;</th>';

            print '</tr></thead>';

            //body

            print "<tbody>";

            while ($row = $this->getRegNumber()) { //N de registros

                print '<tr>';


                for ($j = 0; $j < count($this->getFields()); $j++) { ////N campos

                    ///hidden
                    $bodyHidden = (in_array($j, $hiddenValues)) ? ';display:none' : '';
                    //align
                    $bodyAlign = ($this->align[$j]) ? 'text-align:' . $this->align[$j] : 'text-align:left';
                    //deco
                    $bodyDecoration = ($this->decoration[$j]) ? ';text-transform:' . $this->decoration[$j] : '';
                    //nullcell else nullvalue
                    $row[$j] = ($row[$j] == "") ? $this->nullCell : ($row[$j] == $this->nullValue) ? $this->nullCell : $row[$j];

                    ////maskValue
                    if ($this->maskValue["pos"] == $j) {
                        $mv = array_keys($this->maskValue);
                        for ($m = 1; $m < count($mv); $m++) {
                            if (strtolower($row[$j]) == strtolower($mv[$m])) {
                                $row[$j] = $this->maskValue[$mv[$m]];
                                break;
                            }
                        }

                    }

                    print '<td style="' . $bodyAlign . $bodyDecoration . $bodyHidden . '">' . $row[$j] . '</td>';

                }

                ///links
                if ($this->areLinks()) {

                    print '<td style="text-wrap: none; text-align: center">';
                    ///link1
                    if ($this->link1) {
                        /////uno o varios parametros (vector)
                        $parametros = explode(",",$this->link1["params"]);
                        $paramslink1 = array();
                        for ($p2 = 0; $p2 < count($parametros); $p2++)
                            array_push($paramslink1, $row[$parametros[$p2]]);
                        print '<a href="' . Front::myUrl($this->link1["url"] . implode("/", $paramslink1)) . '">';


                        print '<i style="cursor: pointer" class="' . $this->link1["icon"] . '"></i>';
                        print '</a>';

                    }

                    if ($this->linkDelete) {

                        print '&nbsp;';
                        print '<a onclick="deleteOnClick(' . $row[$this->linkDelete["params"]] . ');">';
                        print '<i style="cursor: pointer" class="' . $this->linkDelete["icon"] . '"></i>';
                        print '</a>';

                    }


                    print '</td>';

                }


                print '</tr>';
            }

            print "</tbody>";
            print "</table>";


        } else {
            print "<div style='padding-left: 150px; font-style: italic;'>" . $this->noResultsMessage . "</div>";
        }


    }


}