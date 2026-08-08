import os
import time
from ftplib import FTP, error_perm

FTP_HOST = "ftpupload.net"
FTP_USER = "if0_42586885"
FTP_PASS = "Arkanza0123456"
REMOTE_ROOT = "fitlifehub.site.je/htdocs"

FILES_TO_PUSH = [
    'routes/api.php',
    'routes/web.php',
    'database/database.sqlite',
    'app/Models/User.php',
    'app/Models/Location.php',
    'app/Models/WorkoutLog.php',
    'app/Models/NutritionLog.php',
    'app/Models/Notification.php',
    'app/Models/MembershipPlan.php',
    'app/Models/Exercise.php',
    'app/Models/ProgramTemplate.php',
    'app/Models/ProgramTemplateWorkout.php',
    'app/Models/WorkoutExercise.php',
    'app/Models/MemberProgram.php',
    'app/Models/MemberProgramWorkout.php',
    'app/Models/WorkoutSession.php',
    'app/Models/MemberProgress.php',
    'app/Models/Video.php',
    'app/Http/Controllers/Api/BookingApiController.php',
    'app/Http/Controllers/Api/PaymentApiController.php',
    'app/Http/Controllers/Api/WorkoutLogApiController.php',
    'app/Http/Controllers/Api/NutritionLogApiController.php',
    'app/Http/Controllers/Api/LeaderboardApiController.php',
    'app/Http/Controllers/Api/BranchApiController.php',
    'app/Http/Controllers/Api/TutorialApiController.php',
    'app/Http/Controllers/Api/NotificationApiController.php',
    'app/Http/Controllers/Api/MembershipPlanApiController.php',
    'app/Http/Controllers/Api/TrainingProgramApiController.php',
    'app/Http/Controllers/Admin/AdminWorkoutLogController.php',
    'app/Http/Controllers/Admin/AdminNutritionLogController.php',
    'app/Http/Controllers/Admin/AdminLeaderboardController.php',
    'app/Http/Controllers/Admin/AdminBranchController.php',
    'app/Http/Controllers/Admin/AdminNotificationController.php',
    'app/Http/Controllers/Admin/AdminMembershipPlanController.php',
    'app/Http/Controllers/Admin/AdminTrainingProgramController.php',
    'app/Http/Controllers/Admin/AdminMemberController.php',
    'resources/views/admin/layout.blade.php',
    'resources/views/admin/members/edit.blade.php',
    'resources/views/admin/members/create.blade.php',
    'resources/views/admin/workout_logs/index.blade.php',
    'resources/views/admin/nutrition_logs/index.blade.php',
    'resources/views/admin/leaderboard/index.blade.php',
    'resources/views/admin/branches/index.blade.php',
    'resources/views/admin/notifications/index.blade.php',
    'resources/views/admin/membership_plans/index.blade.php',
    'resources/views/admin/training_programs/index.blade.php',
    'database/migrations/2026_08_08_000001_create_workout_logs_table.php',
    'database/migrations/2026_08_08_000002_create_nutrition_logs_table.php',
    'database/migrations/2026_08_08_000003_add_reward_points_and_level_badge_to_users_table.php',
    'database/migrations/2026_08_08_000004_add_crowd_meter_to_locations_table.php',
    'database/migrations/2026_08_08_000005_create_notifications_table.php',
    'database/migrations/2026_08_08_000006_create_membership_plans_table.php',
    'database/migrations/2026_08_08_000007_create_exercises_table.php',
    'database/migrations/2026_08_08_000008_create_program_templates_table.php',
    'database/migrations/2026_08_08_000009_create_program_template_workouts_table.php',
    'database/migrations/2026_08_08_000010_create_workout_exercises_table.php',
    'database/migrations/2026_08_08_000011_create_member_programs_table.php',
    'database/migrations/2026_08_08_000012_create_member_program_workouts_table.php',
    'database/migrations/2026_08_08_000013_create_workout_sessions_table.php',
    'database/migrations/2026_08_08_000014_create_member_progress_table.php',
    'database/migrations/2026_08_08_000015_add_membership_price_to_users_table.php',
]

def connect_ftp():
    ftp = FTP()
    ftp.connect(FTP_HOST, 21, timeout=30)
    ftp.login(FTP_USER, FTP_PASS)
    ftp.set_pasv(True)
    return ftp

def ensure_remote_dir(ftp, remote_dir):
    parts = remote_dir.split('/')
    current = ""
    for part in parts:
        if not part:
            continue
        current = f"{current}/{part}" if current else part
        try:
            ftp.mkd(current)
        except error_perm:
            pass

def upload_file(ftp, local_path, remote_path):
    dir_part = os.path.dirname(remote_path)
    if dir_part:
        ensure_remote_dir(ftp, dir_part)
    with open(local_path, 'rb') as f:
        ftp.storbinary(f"STOR {remote_path}", f)

def quick_push():
    print(f"Connecting to {FTP_HOST}...")
    ftp = connect_ftp()
    print("Connected successfully! Uploading modified files...")

    uploaded = 0
    for rel_path in FILES_TO_PUSH:
        if os.path.exists(rel_path):
            remote_file = f"{REMOTE_ROOT}/{rel_path}"
            print(f" -> Uploading {rel_path} ...")
            upload_file(ftp, rel_path, remote_file)
            uploaded += 1

    ftp.quit()
    print(f"SUCCESS: {uploaded} files deployed to FTP server!")

if __name__ == "__main__":
    quick_push()
