<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@ist.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Student user
        $user = User::create([
            'name'     => 'Ahmed Al Mansouri',
            'email'    => 'student@ist.com',
            'password' => Hash::make('password'),
            'role'     => 'student',
        ]);
        // $user = User::create([...]);

// Add this debug line temporarily:
if (!$user || !$user->id) {
    throw new \Exception('User creation failed! Check User $fillable for role.');
}

        Student::create([
            'user_id'          => $user->id,
            'student_id'       => 'ST-2024-001',
            'phone'            => '+971501234567',
            'program'          => 'Web Development',
            'status'           => 'active',
            'enrollment_date'  => '2024-09-01',
        ]);

        // Sample courses
        Course::create([
            'code'        => 'WD-101',
            'name'        => 'Laravel Fundamentals',
            'instructor'  => 'Dr. Hassan Ali',
            'credits'     => 3,
            'schedule'    => 'Mon/Wed 9:00 AM',
            'max_students'=> 30,
            'status'      => 'active',
        ]);

        Course::create([
            'code'        => 'WD-102',
            'name'        => 'React & Node.js',
            'instructor'  => 'Ms. Rania Omar',
            'credits'     => 3,
            'schedule'    => 'Tue/Thu 11:00 AM',
            'max_students'=> 30,
            'status'      => 'active',
        ]);
    }
}