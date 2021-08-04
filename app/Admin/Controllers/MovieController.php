<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Movie;
use App\Models\User;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class MovieController extends AdminController
{
    protected function grid()
    {
        return Grid::make(new Movie(), function (Grid $grid) {

            $grid->model()->where('id','>',5);

            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->column('id', 'ID')->sortable();

            // 第二列显示title字段，由于title字段名和Grid对象的title方法冲突，所以用Grid的column()方法代替
            $grid->column('title');

            // 第三列显示director字段，通过display($callback)方法设置这一列的显示内容为users表中对应的用户名
            $grid->column('director')->display(function($userId) {
                return User::find($userId)->name;
            });

            // 第四列显示为describe字段
            $grid->column('describe');

            // 第五列显示为rate字段
            $grid->column('rate');

            // 第六列显示released字段，通过display($callback)方法来格式化显示输出
            $grid->column('released', '上映?')->display(function ($released) {
                return $released ? '是' : '否';
            });

            // 下面为三个时间字段的列显示
            $grid->column('release_at');
            $grid->column('created_at');
            $grid->column('updated_at');
            $grid->column('updated_at');

            // filter($callback)方法用来设置表格的简单搜索框
            $grid->filter(function (Grid\Filter $filter) {
                // 设置created_at字段的范围查询
                $filter->between('created_at', 'Created Time')->datetime();
            });

            // 开启字段选择器功能
            $grid->showColumnSelector();

            // 设置默认隐藏字段
            $grid->hideColumns(['created_at', 'describe']);
        });
    }
}
