use App\Models\User;

$admin = User::create([
    'name' => 'Admin HRD Test',
    'email' => 'admin@test.com',
    'password' => bcrypt('password123'),
    'role' => 'admin_hrd'
]);
echo "Admin created: " . $admin->email . "\n";

$direktur = User::create([
    'name' => 'Direktur Test',
    'email' => 'direktur@test.com',
    'password' => bcrypt('password123'),
    'role' => 'direktur'
]);
echo "Direktur created: " . $direktur->email . "\n";

$karyawan = User::create([
    'name' => 'Karyawan Test',
    'email' => 'karyawan@test.com',
    'password' => bcrypt('password123'),
    'role' => 'karyawan'
]);
echo "Karyawan created: " . $karyawan->email . "\n";
