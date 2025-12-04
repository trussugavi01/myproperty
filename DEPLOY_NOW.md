# 🚀 Deploy Admin Role - Action Plan

## ✅ Command Verified and Ready

The `user:set-admin` command has been tested and is working correctly.

---

## 📋 Deployment Steps for Live Server

### Step 1: Upload the Command File

Upload this file to your live server:
```
app/Console/Commands/SetAdminRole.php
```

**Upload Location:** Same path structure on your live server
```
/path/to/propertyng2/app/Console/Commands/SetAdminRole.php
```

### Step 2: Connect to Your Live Server

```bash
ssh user@your-live-server.com
```

### Step 3: Navigate to Your Laravel Project

```bash
cd /path/to/propertyng2
# or
cd public_html
# or wherever your Laravel project is located
```

### Step 4: Clear Cache (Optional but Recommended)

```bash
php artisan config:clear
php artisan cache:clear
```

### Step 5: Run the Command

```bash
php artisan user:set-admin chuksokezie@gmail.com
```

### Step 6: Expected Output

```
Successfully set 'chuksokezie@gmail.com' as admin.
User: [User's Name]
Role: admin
```

### Step 7: Verify the Change

```bash
php artisan tinker
```

Then in Tinker:
```php
$user = User::where('email', 'chuksokezie@gmail.com')->first();
echo "Name: " . $user->name . "\n";
echo "Role: " . $user->role . "\n";
echo "Is Admin: " . ($user->isAdmin() ? 'Yes' : 'No') . "\n";
exit
```

---

## 🔄 Alternative: If SSH is Not Available

### Option A: Use cPanel Terminal
1. Log into cPanel
2. Open "Terminal" or "Terminal Emulator"
3. Navigate to your project directory
4. Run the same commands as above

### Option B: Use Web-Based Script
1. Edit `set-admin-web.php` (change security token on line 13)
2. Upload to Laravel root directory
3. Visit: `https://yourdomain.com/set-admin-web.php?token=YOUR_TOKEN`
4. **Delete the file immediately after use**

---

## ⚠️ Prerequisites

Before running the command, ensure:

- [ ] The user `chuksokezie@gmail.com` has already registered on the live site
- [ ] You have SSH or terminal access to the live server
- [ ] PHP CLI is available on the server
- [ ] The Laravel project is properly configured (`.env` file exists)
- [ ] Database connection is working

---

## 🆘 Troubleshooting

### "User not found" Error

The user hasn't registered yet. Check if user exists:
```bash
php artisan tinker
User::where('email', 'LIKE', '%chuksokezie%')->get(['id', 'name', 'email', 'role']);
exit
```

### "Command not found" Error

Clear caches and check:
```bash
php artisan config:clear
php artisan cache:clear
php artisan list | grep user:set-admin
```

### Permission Issues

Check file permissions:
```bash
chmod 644 app/Console/Commands/SetAdminRole.php
```

---

## 📞 Quick Reference Commands

| Task | Command |
|------|---------|
| Set admin | `php artisan user:set-admin chuksokezie@gmail.com` |
| Check user | `php artisan tinker` then `User::where('email', 'chuksokezie@gmail.com')->first()` |
| Clear cache | `php artisan cache:clear` |
| List commands | `php artisan list` |
| View help | `php artisan user:set-admin --help` |

---

## ✅ Post-Deployment Verification

After successful deployment:

1. **Test Login**
   - Log in as `chuksokezie@gmail.com`
   - Verify admin menu appears

2. **Test Admin Access**
   - Navigate to `/admin/users`
   - Check if you can access admin features

3. **Database Check**
   ```sql
   SELECT id, name, email, role 
   FROM users 
   WHERE email = 'chuksokezie@gmail.com';
   ```

---

## 🎯 Ready to Deploy?

1. Upload `app/Console/Commands/SetAdminRole.php` to your live server
2. SSH into your server
3. Run: `php artisan user:set-admin chuksokezie@gmail.com`
4. Verify the change
5. Test admin access

**That's it!** 🎉

---

**Need help?** Check `ADMIN_SETUP_README.md` for detailed troubleshooting.
