import os
import time
from ftplib import FTP, error_perm

FTP_HOST = "185.27.134.11"
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
    'app/Models/Product.php',
    'app/Models/PurchaseOrder.php',
    'app/Models/PurchaseOrderItem.php',
    'app/Models/Locker.php',
    'app/Models/PtCommissionPayout.php',
    'app/Models/StaffShift.php',
    'app/Models/StaffAttendance.php',
    'app/Models/ClassBooking.php',
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
    'app/Http/Controllers/Api/StaffAttendanceApiController.php',
    'app/Http/Controllers/Admin/AdminWorkoutLogController.php',
    'app/Http/Controllers/Admin/AdminNutritionLogController.php',
    'app/Http/Controllers/Admin/AdminLeaderboardController.php',
    'app/Http/Controllers/Admin/AdminBranchController.php',
    'app/Http/Controllers/Admin/AdminNotificationController.php',
    'app/Http/Controllers/Admin/AdminMembershipPlanController.php',
    'app/Http/Controllers/Admin/AdminTrainingProgramController.php',
    'app/Http/Controllers/Admin/AdminMemberController.php',
    'app/Http/Controllers/Admin/AdminPosController.php',
    'app/Http/Controllers/Admin/AdminPurchaseOrderController.php',
    'app/Http/Controllers/Admin/AdminLockerController.php',
    'app/Http/Controllers/Admin/AdminPtCommissionController.php',
    'app/Http/Controllers/Admin/AdminStaffShiftController.php',
    'app/Http/Controllers/Admin/AdminClassController.php',
    'app/Http/Controllers/Admin/AdminWaBroadcastController.php',
    'app/Services/WhatsAppService.php',
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
    'resources/views/admin/pos/products.blade.php',
    'resources/views/admin/pos/barcode_print.blade.php',
    'resources/views/admin/purchase_orders/index.blade.php',
    'resources/views/admin/purchase_orders/create.blade.php',
    'resources/views/admin/purchase_orders/show.blade.php',
    'resources/views/admin/lockers/index.blade.php',
    'resources/views/admin/pt_commissions/index.blade.php',
    'resources/views/admin/pt_commissions/slip.blade.php',
    'resources/views/admin/staff_shifts/index.blade.php',
    'resources/views/admin/classes/index.blade.php',
    'resources/views/admin/wa_broadcast/index.blade.php',
    'database/migrations/2026_08_09_000009_create_purchase_orders_table.php',
    'database/migrations/2026_08_09_000010_create_lockers_table.php',
    'database/migrations/2026_08_09_000011_create_pt_commission_payouts_table.php',
    'database/migrations/2026_08_09_000012_create_staff_shifts_and_attendances_tables.php',
    'database/migrations/2026_08_09_000013_create_class_bookings_table.php',
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
    print("🚀 Starting FTP Quick Sync to fitlifehub.site.je...", flush=True)
    ftp = connect_ftp()
    
    success = 0
    failed = 0
    for local_file in FILES_TO_PUSH:
        if not os.path.exists(local_file):
            print(f"⚠️ File local tidak ditemukan: {local_file}", flush=True)
            failed += 1
            continue
            
        remote_path = f"{REMOTE_ROOT}/{local_file}"
        try:
            upload_file(ftp, local_file, remote_path)
            print(f"✅ Uploaded: {local_file}", flush=True)
            success += 1
        except Exception as e:
            print(f"❌ Error uploading {local_file}: {e}", flush=True)
            failed += 1
            # Reconnect if dropped
            try:
                ftp.quit()
            except:
                pass
            time.sleep(1)
            ftp = connect_ftp()
            
    try:
        ftp.quit()
    except:
        pass
        
    print(f"\n🎉 FTP Sync Finished! Success: {success}, Failed: {failed}", flush=True)

if __name__ == "__main__":
    quick_push()
