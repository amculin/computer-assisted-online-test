<?php

namespace app\models;

use Yii;
use mdm\admin\models\User as MdmUser;
USE yii\web\IdentityInterface;

class UserIdentity extends MdmUser implements IdentityInterface
{
    const INACTIVE = 0;
    const ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'in', 'range' => [self::ACTIVE, self::INACTIVE]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                'password_reset_token' => $token,
                'status' => self::ACTIVE,
        ]);
    }

    /** 
    * Gets query for [[TesteesData]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getTesteesData() 
    { 
        return $this->hasOne(BaseTesteesData::className(), ['user_id' => 'id']); 
    }

    public function getUserLogo()
    {
        if ($this->type == BaseUser::ADMINISTRATOR)
            return 'admin.png';
        else if ($this->type == BaseUser::TESTER)
            return 'officer.png';
        else
            return 'cadet.png';
    }

    public function getTypeName()
    {
        if ($this->type == BaseUser::ADMINISTRATOR)
            return 'Administrator';
        else if ($this->type == BaseUser::TESTER)
            return 'Tester';
        else
            return 'Siswa';
    }

    public function getMenuList()
    {
        if ($this->type == BaseUser::ADMINISTRATOR) {
            return [
                /* [
                    'name'  => 'User Management',
                    'url'   => '/admin/user'
                ],
                [
                    'name'  => 'Role Management',
                    'url'   => '/admin/role'
                ],
                [
                    'name'  => 'Permission Management',
                    'url'   => '/admin/permission'
                ],
                [
                    'name'  => 'Route Management',
                    'url'   => '/admin/route'
                ],
                [
                    'name'  => 'Assignment Management',
                    'url'   => '/admin/assignment'
                ] */
                [
                    'name'  => 'Manajemen Siswa',
                    'url'   => '/admin/student/index'
                ],
                [
                    'name'  => 'Manajemen Kelas',
                    'url'   => '/admin/class/index'
                ],
                [
                    'name'  => 'Manajemen Jenis Tes',
                    'url'   => '/admin/test-class/index'
                ],
                [
                    'name'  => 'Manajemen Tes',
                    'url'   => '/admin/test/index'
                ],
                [
                    'name'  => 'Manajemen Sesi Tes',
                    'url'   => '/admin/test-session/index'
                ],
                [
                    'name'  => 'Rekap Nilai',
                    'url'   => '/admin/score/index'
                ],
                [
                    'name'  => 'Nilai Siswa',
                    'url'   => '/admin/score/index'
                ],
            ];
        } elseif ($this->type == BaseUser::TESTER) {
            return [

            ];
        } else {
            return [
                [
                    'name'  => 'Dashboard',
                    'url'   => '/student/dashboard/index'
                ],
                [
                    'name'  => 'Test',
                    'url'   => '/student/test-type/index'
                ],
                [
                    'name'  => 'Rekap Nilai',
                    'url'   => '/student/score/index'
                ]
            ];
        }
    }
}