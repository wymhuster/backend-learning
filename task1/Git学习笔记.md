# Git学习笔记


---

**添加本地修改到暂存区和仓库**
------------------

 
    
    git add <file-name>     //将本地修改添加到暂存区
    git commit -m "<note>"      //将暂存区修改提交到仓库
    


----------

**查看当前仓库状态**
------------------

    git status

----------
**查看本地文件与仓库最新版本的区别**
------------------

    git diff <file-name>        //在暂存区有此文件时比较与暂存区的区别
                                //在暂存区无此文件时比较与仓库的区别
    git diff HEAD --<file-name>     //比较工作区此文件与仓库此文件的区别

 
- 当出现**no newline at end of file**时表示文档末尾无换行符，用以区别结尾有换行符和无换行符文件的区别

----------

**查看版本更改记录**
------------------

    git log     //查看上传到仓库的更改的完整信息（若退回之前版本则信息没有退回的版本之后的信息）
    git log --pretty=oneline        //只查看单行简短信息
    git reflog      //查看所有对仓库进行修改的信息（在回退版本后可通过此命令再更改回来）

----------
**管理更改**
------------------

    git reset --hard HEAD~<num>      //回退到当前版本之前的若干个版本
    git reset –-hard <commit id>     //回退到与版本id一致的版本

----------
**创建SSH key**
------------------

    ssh-keygen -t rsa -C email@ex.com

----------
**本地库与远程库连接**
------------------

    git remote add origin git@github.com:my_name/mygit.git      //将远程库与本地库相连
    git remote remove origin      //取消相连
    
----------
**从远程库下载**
------------------

    git clone git@github.com:user_name/por.git  
    git clone https://github.com/user_name/por.git
    
----------
**操作分支**
------------------

    git checkout -b <branch-name>     //创建并切换分支
    git branch <branch-name>        //创建分支
    git checkout <branch-name>      //切换分支
    git branch      //查看分支
    git merge <branch-name>     //合并分支
    git branch -d <branch-name>     //删除分支
    git log --graph     //查看图分支
    git merge –-no-ff –m <note> <branch>            //不使用fast-forward相当于在合并分支时重新commit了一次，而不是简单的改变maste指针  
    git branch -D <branch-name>     //强行删除未合并分支
    
----------

**对分支进行暂存**
------------------

    git stash       //对分支进行暂存
    git stash list      //查看暂存分支
    git stash apply     //恢复暂存分支
    git stash drop      //删除暂存分支记录
    git stash pop       //恢复暂存分支并删除记录
    
    
----------
**远程分支和本地分支更新**
------------------

    git remote -v       //查看远程分支
    git pull        //抓取远程的新提取
    git checkout -b branch-name origin/branch-name      //在本地创建和远程分支对应的分支
    git branch --set-upstream branch-name origin/branch-name      //建立远程分支和本地分支的关联
    git rebase      //将本地分支提交历史整理成直线
    git push origin <branch-name>:refs/<branch-name>      //将本地分支推送到远程指定分支
    git fetch origin <branch-name>:<newbranch-name>      //将远程指定分支更新到本地指定分支

 - 可以认为git pull是git fetch和git merge的结合

    
----------
**远程分支和本地分支更新**
------------------


    git tag <tag-name>      //为当前commit版本创建tag标签
    git tag -a <tag-name> -m <note>      //指定标签信息
    git tag     //查看所有标签
    git push origin <tag-name>      //推送本地标签
    git push origin --tags      //推送本地所有未推送标签到远程
    git tag -d <tag-name>      //删除本地标签
    git push origin :refs/tags/<tag-name>       //删除远程标签

    
----------