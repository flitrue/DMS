<?php

namespace Home\Controller;
use Boris\DumpInspector;
use Think\Controller;

class SearchController extends CommonController
{

    public function search()
    {
        $name = I("get.name");
        $search = $_POST['bigsearch'];
        if ($name == "user") {
            $this->staff($search);
        } elseif ($name == 'device') {
            $this->device($search);
        } elseif ($name == 'document') {
            $this->document($search);
        } elseif ($name == 'patent') {
            $this->patent($search);
        } else {
            // todo 添加其他搜索
        }

    }

    public function staff($search)
    {

        $model = M('user');
        $uid = session("uid");
        $review = $model->field("review")->where("id=$uid")->select();
        if ($review[0]['review']) {
            $data["name"] = array("like", array("%" . $search . "%"));
            $data['depart'] = array("like", array("%" . $search . "%"));
            $data['group'] = array("like", array("%" . $search . "%"));
            $data['_logic'] = 'OR';
            $arr = $model->field("id,name,depart,idcard,group,email,status,time,code")
                ->where($data)
                ->select();
        } else {
            $arr = [];
        }
        $html = "<div class='table-responsive'>
                                <form id='select' action='' method='post' enctype='multipart/form-data'>
                                    <table id='staff-table' class='sortable table table-striped table-bordered table-hover'>
                                        <thead>
                                        <tr>
                                            <th class='noprint sorttable_nosort'>
                                                <label>
                                                    <input type='checkbox' name='checkbox' class='ace' />
                                                    <span class='lbl'></span>
                                                </label>
                                            </th>
                                            <th>姓名</th>
                                            <th>状态</th>
                                            <th>邮箱</th>
                                            <th>身份证号</th>
                                            <th>部门</th>
                                            <th>小组</th>
                                            <th>入职时间</th>

                                            <th class='noprint'>操作</th>
                                        </tr>
                                        </thead>

                                        <tbody>";

        $url1 = U("staff/detail");
        $url2 = U("staff/writeemail");
        foreach ($arr as $k => $v) {
            $html .= "
            <tr>
                <td class='center noprint'>
                    <label>
                        <input type='checkbox' name='{$v['name']}' value='{$v['id']}' class='ace' />
                        <span class='lbl'></span>
                    </label>
                </td>

                <td><a href='$url1&uid={$v['id']}' title='查看详细信息'>{$v['name']}</a></td>
                <td>
                    <span class='staffstatus label label-lg arrowed arrowed-right'>{$v['status']}</span>
                </td>

                <td><a href='$url2&uid={$v['id']}' title='点击发送邮件'>{$v['email']}</a></td>
                <td>{$v['idcard']}</td>
                <td><nobr>{$v['depart']}</nobr></td>
                <td><nobr>{$v['group']}</nobr></td>
                <td>{$v['time']}</td>

                <td class='noprint'>
                    <nobr>
                        <div>

                            <a onclick='checkpower();editstaffinfo({$v['id']});' class='btn btn-xs btn-info' title='编辑'>
                                <i class='icon-edit bigger-120'></i>
                            </a>
                            <a class='btn btn-info btn-xs btn-danger bootbox-confirm' onclick='checkpower();deletestaffinfo({$v['id']});' title='删除'>
                                <i class='icon-trash bigger-120'></i>
                            </a>
                            <a href='{$url1}&uid={$v['id']}' class='btn btn-xs btn-warning' title='查看详细信息'>
                                <i class='icon-eye-open bigger-120'></i>
                            </a>

                            <a href='{$url2}&uid={$v['id']}' class='btn btn-xs btn-inverse' title='发送邮件'>
                                <i class='icon-plane bigger-120'></i>
                            </a>
                        </div>
                    </nobr>
                </td>
            </tr>";
        }
        $html .= "</tbody></table></form></div>";

        if ($arr) {

            $json = array(
                'code' => 200,
                'msg' => "获取到数据",
                'html' => $html
            );
        } else {
            $json = array(
                'code' => 404,
                'msg' => "没有相关数据"
            );
        }
        echo json_encode($json);
    }

    public function device($search)
    {
        $model = M();

        $data["name"] = array("like", array("%" . $search . "%"));
        $data['depart'] = array("like", array("%" . $search . "%"));
        $data['group'] = array("like", array("%" . $search . "%"));
        $data['_logic'] = 'OR';

        $sql = <<<EOF
        SELECT
        de.id did,us.id uid,tr.id,ca.name category,
        de.name devicename,de.version,de.code,de.tag,de.price,
        de.keyinfo,de.remarks,de.buytime,de.buyer,tr.status,
        us.name username
        FROM am_device de 
        LEFT JOIN am_transaction tr ON (tr.did=de.id) 
        LEFT JOIN am_user us ON (tr.uid=us.id)
        LEFT JOIN am_category ca ON (ca.id=de.category)
        where de.name like "%$search%" or de.depart like "%$search%" or de.group like "%$search%"
EOF;
        $arr = $model->query($sql);


        $html = "<div class='table-responsive'>
                                <form id='select' action='' method='post' enctype='multipart/form-data'>
                                    <table id='staff-table' class='sortable table table-striped table-bordered table-hover'>
                                        <thead>
                                        <tr>
                                            <th class='noprint sorttable_nosort'>
                                                <label>
                                                    <input type='checkbox' name='checkbox' class='ace' />
                                                    <span class='lbl'></span>
                                                </label>
                                            </th>
                                            <th>设备名</th>
                                            <th>状态</th>
                                            <th>使用人</th>
                                            <th>类型</th>
                                            <th>价格</th>
                                            <th>关键信息</th>
                                            <th>购买时间</th>

                                            <th class='noprint'>操作</th>
                                        </tr>
                                        </thead>

                                        <tbody>";

        $url1 = U("device/detail");
        $url2 = U("staff/detail");
        foreach ($arr as $k => $v) {
            $html .= "
            <tr>
                                        <td class='noprint'>
                                            <label>
                                                <input type='checkbox' value='{$v['did']}' class='ace' />
                                                <span class='lbl'></span>
                                            </label>
                                        </td>

                                        <td><nobr><a href='$url1&did={$v['did']}'>{$v['devicename']}</a></nobr></td>
                                        <td>
                                            <nobr>
                                                <span class='devicestatus label label-lg arrowed-right'>{$v['status']}</span>
                                            </nobr>
                                        </td>
                                        <td>
                                            <a href='$url2&uid={$v['uid']}' title='查看该员工'>
                                                {$v['username']}
                                            </a>
                                        </td>
                                        <td><nobr>{$v['category']}</nobr></td>
                                        <td>{$v['price']}</td>
                                        <td>{$v['keyinfo']}</td>
                                        <td><nobr>{$v['buytime']}</nobr></td>
                                        <td class='noprint'>
                                            <nobr>
                                            <div>

                                                <a onclick='editdeviceinfo({$v['did']});' class='btn btn-xs btn-info' title='编辑'>
                                                    <i class='icon-edit bigger-120'></i>
                                                </a>
                                                <a class='btn btn-info btn-xs btn-danger bootbox-confirm' onclick='deldeviceinfo({$v['did']}{$v['id']});' title='删除'>
                                                    <i class='icon-trash bigger-120'></i>
                                                </a>

                                                <a class='btn btn-xs btn-warning' onclick='detaildeviceinfo({$v['did']});' title='查看详细信息'>
                                                    <i class='icon-eye-open bigger-120'></i>
                                                </a>
                                            </div>
                                            </nobr>
                                        </td>
                                    </tr>
            ";
        }
        $html .= "</tbody></table></form></div>";

        if ($arr) {

            $json = array(
                'code' => 200,
                'msg' => "获取到数据",
                'html' => $html
            );
        } else {
            $json = array(
                'code' => 404,
                'msg' => "没有相关数据",
            );
        }
        echo json_encode($json);
    }

    public function document($search)
    {
        $model = M();

        $sql = <<<EOF
SELECT doc.id id,doc.name,doc.source,doca.name category,doc.uploadtime,us.name username,us.id uid,doc.url,doc.size
from am_document doc 
left join am_documentcategory doca
on doca.id=doc.category
left join am_user us
on doc.uid=us.id
where doc.name like "%$search%"
or doca.name like "%$search%"
or doc.tag like "%$search%"
EOF;
        $arr = $model->query($sql);

        if ($arr) {
            $html = "
            <div class='table-responsive'>
               <form id='select'  method='post' enctype='multipart/form-data' action=''>
                   <table id='sample-table-1' class='table table-striped table-bordered table-hover sortable'>
                       <thead>
                       <tr style='text-align: center'>
                           <th class='noprint sorttable_nosort'>
                               <label>
                                   <input type='checkbox' class='ace' />
                                   <span class='lbl'></span>
                               </label>
                           </th>
                           <th>文档名</th>
                           <th>类型</th>
                           <th>大小</th>
                           <th>上传人</th>
                           <th>上传时间</th>
                           <th class='noprint'>操作</th>
                       </tr>
                       </thead>
                       <tbody>
            ";
            $url1 = U("document/detail");
            $url2 = U("staff/detail");
            foreach ($arr as $k => $v) {
                $size = round($v['size'] / 1024, 2);
                $html .= "
                <tr>
                   <td class='noprint sorttable_nosort'>
                       <label>
                           <input type='checkbox' name='{$v['name']}' value='{$v['id']}' class='ace' />
                           <span class='lbl'></span>
                       </label>
                   </td>

                   <td><nobr><a href='$url1&id={$v['id']}'>{$v['name']}</a></nobr></td>
                   <td><nobr>{$v['category']}</nobr></td>
                   <td>{$size}KB</td>
                   <td><a href='$url2&uid={$v['uid']}'>{$v['username']}</a></td>
                   <td><nobr>{$v['uploadtime']}</nobr></td>
                   <td class='noprint'>
                       <nobr>
                           <div>

                               <a class='btn btn-purple btn-xs' onclick='' title='下载'>
                                   <i class='icon-download-alt bigger-120'></i>
                               </a>

                               <a onclick='editdocumentinfo({$v['id']})' class='btn btn-xs btn-info' title='编辑'>
                                   <i class='icon-edit bigger-120'></i>
                               </a>
                               <a class='btn btn-info btn-xs btn-danger bootbox-confirm' onclick='checkpower();deldocumentinfo({$v['id']}})' title='删除'>
                                   <i class='icon-trash bigger-120'></i>
                               </a>

                               <a class='btn btn-xs btn-warning' onclick='detaildocumentinfo({$v['id']});' title='查看详细信息'>
                                   <i class='icon-eye-open bigger-120'></i>
                               </a>
                           </div>
                       </nobr>
                   </td>
               </tr>
                ";
            }
            $html .= "</tbody></table></form></div>";
            $json = array(
                'code' => 200,
                'msg' => "获取到数据",
                'html' => $html
            );
        } else {
            $json = array(
                'code' => 404,
                'msg' => "没有相关数据"
            );
        }
        echo json_encode($json);
    }

    public function patent($search)
    {
        $model = M();

        $sql = <<<EOF
SELECT pa.id pid,pa.name,max(pas.status) status,pac.name category,us.name username,us.id uid,us1.name operator,us1.id oid
from am_patent pa
left join am_patentstatus pas
on pa.id=pas.pid 
left join am_patentcategory pac 
on pa.category=pac.id
left join am_user us
on us.id=pa.uid
left join am_user us1
on us1.id=pa.operator
where pa.name like "%$search%"
or pac.name like "%$search%"
or pa.remarks like "%$search%"
EOF;
        $arr = $model->query($sql);
        if ($arr[0]['pid']) {
            $html = "
            <div class='table-responsive'>
                <form id='select'  method='post' enctype='multipart/form-data'>
                    <table id='sample-table-1' class='table table-striped table-bordered table-hover sortable'>
                        <thead>
                        <tr style='text-align: center'>
                            <th class='noprint sorttable_nosort'>
                                <label>
                                    <input type='checkbox' class='ace' />
                                    <span class='lbl'></span>
                                </label>
                            </th>
                            <th>专利名</th>
                            <th>状态</th>
                            <th>类型</th>
                            <th>申请人</th>
                            <th>操作人</th>
                            <th class='noprint'>操作</th>
                        </tr>
                        </thead>
                        <tbody>
            ";
            $url1 = U('patent/detail');
            $url2 = U('staff/detail');
            foreach ($arr as $k => $v) {
                switch ($v['status']){
                    case '1':
                        $v['status'] = '受理';
                        break;
                    case '2':
                        $v['status'] = '初审';
                        break;
                    case '3':
                        $v['status'] = '公布';
                        break;
                    case '4':
                        $v['status'] = "实申";
                        break;
                    case '5':
                        $v['status'] = '授权';
                        break;
                    default:
                        break;
                }
                $html .= "
                <tr>
                    <td class='center noprint'>
                        <label>
                            <input type='checkbox' name='{$v['name']}' value='{$v['pid']}' class='ace' />
                            <span class='lbl'></span>
                        </label>
                    </td>

                    <td><nobr><a href='$url1&id={$v['id']}'>{$v['name']}</a></nobr></td>
                    <td>
                        <nobr>
                            {$v['status']}
                        </nobr>
                    </td>
                    <td><nobr>{$v['category']}</nobr></td>
                    <td><a href='$url2&uid={$v['uid']}' title='查看员工信息'>{$v['username']}</a></td>
                    <td><a href='$url2&uid={$v['oid']}' title='查看员工信息'>{$v['operator']}</a></td>

                    <td class='noprint'>
                        <nobr>
                            <div>
                                <a class='btn btn-purple btn-xs' onclick='downloadpatentinfo({$v['pid']})' title='下载'>
                                    <i class='icon-download-alt bigger-120'></i>
                                </a>

                                <a onclick='editpatentinfo({$v['pid']});' class='btn btn-xs btn-info' title='编辑'>
                                    <i class='icon-edit bigger-120'></i>
                                </a>
                                <a class='btn btn-info btn-xs btn-danger bootbox-confirm' onclick='delpatentinfo({$v['pid']});' title='删除'>
                                    <i class='icon-trash bigger-120'></i>
                                </a>

                                <a class='btn btn-xs btn-warning' onclick='detailpatentinfo({$v['pid']})' title='查看详细信息'>
                                    <i class='icon-eye-open bigger-120'></i>
                                </a>
                            </div>
                        </nobr>
                    </td>
                </tr>
                ";
            }
            $html .= "</tbody></table></form></div>";

            $json = array(
                'code'  =>  200,
                'msg'   =>  "获取到数据",
                'html'  =>  $html
            );
        }else{
            $json = array(
                'code'  =>  404,
                'msg'   =>  "没有相关数据"
            );
        }
        echo json_encode($json);
    }
}