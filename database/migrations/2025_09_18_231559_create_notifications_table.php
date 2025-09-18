<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            // ينشئ عمود id من نوع UUID ويجعله المفتاح الأساسي للجدول (معرّف فريد لكل إشعار)

            $table->string('type'); 
            // ينشئ عمود type لتخزين نوع الإشعار (مثلاً: رسالة، تعليق، إلخ)

            $table->morphs('notifiable'); 
            // ينشئ عمودين (notifiable_id و notifiable_type) لتحديد الكيان المرتبط بالإشعار (مثل مستخدم أو نموذج آخر)، ويستخدم للعلاقات متعددة الأشكال (Polymorphic)

            $table->text('data'); 
            // ينشئ عمود data لتخزين بيانات الإشعار (عادةً تكون بيانات JSON أو نص طويل)

            $table->string('username')->nullable(); 
            // ينشئ عمود username لتخزين اسم المستخدم المرتبط بالإشعار، ويقبل القيمة null إذا لم يكن هناك اسم مستخدم مرتبط

            $table->string('user_image')->nullable(); 
            // ينشئ عمود user_image لتخزين صورة المستخدم المرتبط بالإشعار، ويقبل القيمة null إذا لم يكن هناك صورة مرتبطة

            $table->string('post_link')->nullable(); 
            // ينشئ عمود post_link لتخزين رابط المنشور المرتبط بالإشعار، ويقبل القيمة null إذا لم يكن هناك منشور مرتبط

            $table->timestamp('read_at')->nullable(); 
            // ينشئ عمود read_at لتخزين وقت قراءة الإشعار، ويقبل القيمة null إذا لم يُقرأ بعد

            $table->timestamps(); 
            // ينشئ عمودين created_at و updated_at لتخزين وقت الإنشاء والتحديث تلقائياً
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
