<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MemberPostRequest;
use App\Http\Controllers\Controller;
use App\AdminMember;
use App\MemberPhone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class memberController extends Controller
{
    
    /**
     * @Desc: 會員列表
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function memberList(Request $request)
    {
        $wd   = $request->get('wd');
        $data = AdminMember::when($wd, function(Builder $query) use ($wd) {
            $query->whereHas('phone', function ($query) use ($wd){
                return $query->where('phone' , 'like' , "%{$wd}%");
            });
        });

        $list = $data->paginate(10);

        //$aaa  = AdminMember::find(3)->getMemberPhone();
        

        return view('admin.member', ['list' => $list, 'wd' => $wd]);
    }

    /**
     * @Desc: 添加會員
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function memberAddView(Request $request)
    {
        return view('admin.member_add');
    }


        /**
     * @Desc: 添加會員POST
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function memberAdd(MemberPostRequest $request)
    {
        $data   = $request->post();
        /*
        $member = new AdminMember();
        $member->fill($data)->save();
        if ($member->id != ''){
            $phone  = new MemberPhone();
            $phone->phone   = $data['phone'];
            $phone->user_id = $member->id;
            $phone->save();
        }
        */


        DB::beginTransaction();

        try {
            DB::table('admin_members')->insert(
                array(
                    'avatar' => $data['avatar'], 
                    'name' => $data['name'] , 
                    'nickname' => $data['nickname'] , 
                    'account' => $data['account'] , 
                    'password' => $data['password'] , 
                    'email' => $data['email'] , 
                )
            );
            $user_id = DB::getPdo()->lastInsertId();
            
            DB::table('member_phones')->insert(
                array(
                    'phone' => $data['phone'], 
                    'user_id' => $user_id
                )
            );
        
            DB::commit();
            // all good

            return $this->json(200, '添加成功');
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong

            return $this->json(200, '添加失敗');
        }

        
    }
    

    /**
     * @Desc: 修改會員資料
     * @Author: woann <304550409@qq.com>
     * @param Request $request
     * @param $id
     * @return \Illuminate\View\View
     */
    public function memberUpdateView(Request $request, $id)
    {
        return view('admin.member_update', ['member' => AdminMember::findOrFail($id)]);
    }

    public function memberUpdate(Request $request, $id)
    {
        $config = AdminMember::findOrFail($id);
        $data   = $request->post();
        $config->fill($data);
        $config->save();
        return $this->json(200, '修改成功');
    }


    /**
     * @Desc: 刪除會員
     * @param $id
     * @return mixed
     */
    public function memberDel($id)
    {
        AdminMember::findOrFail($id)->delete();
        return $this->json(200, '删除成功');
    }




    

    
    
}
