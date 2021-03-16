# file-menjr
PHP da qilingan va phpda ishlovchi saytlar uchun fayl menjr

[Vaqtinchalik namuna](http://manager.webschool.uz/manager/) parol: `johncms`

# O'rnatish
1. Kodni ZIP qilib yuklab oling 
2. Saytning bosh papkasiga zipni yuklang
3. Zipdan chiqaring
4. http://saytingiz.uz/manager/ ga kiring
5. Kirish uchun demo parol: `johncms`

# Parolni yanglilash
`manager/classes/yadro.php` dagi `define('PASSWORD', '7b00f8fc9bd0b49025a4c5e09b8ebed3');` ni o'zgartirasiz.
Parol md5da ikki marta shifrlangan bo'lishi kerak `echo md5(md5('buparol'));` shaklida shifrlangan parolni qo'yasiz

Agarda siz demo versiyani ishga tushurmoqchi bo'lsangiz `manager/classes/yadro.php` dagi `define('DEMO_VERSION', false);` ni `define('DEMO_VERSION', true);` qilishingiz kerak

# Qilingan ishlar
Hozircha qilingan  o'zgarishlar 

1. Jami fayllar va papkalarni ko'rish
2. Faylni kodlarini ko'rish taxrirlash qayta nomlash o'chirish yangi fayl ochish
3. Papkani ko'rish taxrirlash qayta nomlash o'chirish yangi papka ochish

Undan tashqari kod yozishni qiziqarli qilish va tezroq kod yozishga oson bo'lishi uchun zamonaviy [Ace Editor](https://ace.c9.io/) qo'yildi.

File menjrda kodni taxrirlab `ctrl+s` yoki `shift+f12` qilib saqlaganingizda sahifa yangilanmay kodingizni saqlaydi va yana kod yozaverasiz (bunda kodingizni `ctrl+z` qilib asil holatigacha qaytarish mumkun.)

[Ace Editor](https://ace.c9.io/) da `ctrl+alt+h` qilinsa barcha tezkor klavishlarni ko'rsatadi.
`ctrl+,` da esa [Ace Editor](https://ace.c9.io/) ning yoqilgan barcha funsiyalarini ko'rish o'zgartirish mumkun. (O'zgarishlar Kod editor yopilgandan so'ng o'chib ketadi "Hozircha")

# Eng tezkor klavishlar
1. `Ctrl+S` va `SHift+F12` faylni saqlash
2. `Esc` ochilgan kod editorni yopadi
3. `Ctrl+b` faylning joriy vaqtidan nusxa olib qo'yish (bunda fayl o'sha holatidan yangi nom bilan o'sha papkaga yangi fayl sifatida saqlanadi)
4. `shift+f` yangi fayl ochadi (nom berish uchun popup chiqari)
5. `shift+p` yangi papka ochadi (nom berish uchun popup chiqari)

# Tezkor klavishlar
# Кодларни яшириш

alt+l				kodni belgilab bosilsa o'sha kodni yashiradi

alt+shift+l			tepadagini teskarisi yashirilgan kodni ko'rsatadi

F2				divni ichida turgan bo'lsa o'sha divni o'zini belgilamay yashirib qo'yadi

Alt+F2				Tepadagini teskarisi yashirilganni ochadi

alt+0				hamma kodlarni yashiradi

alt+shift+0			tepadagini teskarisi yashirilganni ochadi


# Сўзларни белгилаш

ctrl+shift+home			belgilangan qatordan tepasidagi hamma so'zni belgilaydi

ctrl+shift+end			kursorning pastini hamma so'zni belgilaydi

shift+down			kursordan pastni belgilaydi

shift+end			kursor kodni chap tarafida bo'sa o'sha kodni hammasini belgilaydi

shift+home			kursot kodni o'ng ratafida bo'sa o'sha kodni hmmasini belgilaydi

ctrl+shift+p || ctrl+shift+\	tepadaginga o'xshaydi div ichiadi barcha so'zni belgilaydi (o'chirishingiz mumkun)

ctrl+shift+m			div ning eng tugashiga kursorni olib boradi yana bosilsa o'sha div ichiadi hamma so'zni belgilaydi (like)

shift+end || shift+home		Kursor dan oldin va keyngi o'sha qatordagi hamma matinni o'sha belgilaydi

ctrl+alt+k			belgilandan so'zni koddagi hammasini belgilaydi

ctrl+shift+l			kursor turgan qarotni hammasini belgilaydi agarda yana bosilsa o'sha qatordan pastiga yana belgilab tushib ketadi


# Коментарияга олиш

ctrl+shift+/			belgilangan kodni komentariyaga oladi


# Кодларни ўчрииш

ctrl+d				O'sha qatorni butunlar o'chiradi

insert				so'z yozildi va eski so'zlarni o'chiriib ketadi (oldindagi sozlar ochiriladi)

dellete 			kursordan keyngi bitta harfni o'chiradi

shift+dellete			kursordan oldingi bitta harfni o'chiradi

alt+Backspace			kursordan oldingi o'sha qarotdagi hamma so'zni o'chiradi

alt+dellete			kursordan keyngi o'sha qarotdagi hamma so'zni o'chiradi

ctrl+shift+backspace		kursordan oldingi kodni hammasini o'chiradi o'chiradi o'sha qatorni

ctrl+shift+dellete		kursordan keyngi hammasini o'chiradi o'sha qatorni

ctrl+shift+'			qandaydur nimadurni o'chiradi

ctrl+shift+;			divning otasini o'chiradi


# Курсор бўйича амаллар

ctrl+u				kursorda turgan harni hammasini katta qiladi

ctrl+shift+u			kursorda turgan harni hammasini kichik qiladi

ctrl+home			kursorni eng tepaga o'tkazadi

ctrl+end			kursorni eng pastga o'tkazadi

down || PgDn			kursorni eng pastga olib tushadi

ctrl+l				menyu ochiladi va qatorni raqamini yozsa o'sha qatorga kursor o'tadi

ctrl+\ || cltr+p		kursorni o'sha divni ichidagi birinchi va oxirgi so'zga o'tkazadi

ctrl+shift+.			kengi div ichiga o'tadi classlar va idlar bilan (unchalik tushunmadim) tepadan pastga

ctrl+shift,			tepadagini teskarisi pasdan tepaga

alt+j				divni boshida va oxiriga chiqadsi va tushadi

alt+left			nimaligini to'liq tushunib yetmadim

clt+left 			so'zlardan keyngisiga o'tkazadi


# Нусха олиш ва ташлаш

ctrl+shift+d 			o'sha qatordagi kodni pastgi qatorga kopy nusxasini tashlaydi


# Сўзларни кидириш топиш ва алмаштириш

alt+k				so'zlarni qidiradi va keyngisiga o'tkazadi

ctrl+f 				so'zni qidirish

ctrl+h				matinni almashtirish menyusini ochadi so'zni belgilasa o'sha so'z searchga avto yoziladi

ctrl+k				matnni belgilab bosilganda o'sha matnning boshqasini topib o'shanga o'tadi tepadan pastga

ctrl+shift+k			tepadagini o'zi faqat pastdan tepaga


# Таблар бўйича ишлар таб олинга силжитиш кодни олдинга силжитиш

shift+tab			o'sha qator kodni bitta tab oldinga siljitadi

ctrl+[ 				o'sha qator kodini oldiga bitta tabni o'chiradi

ctrl+]				o'sha qator kodini oldiga bitta tabni qo'shadi

ctrl+alt+s			belgilangan kodni teadagini pastga pasdagini tepaga almashtiradi

alt+shift+x			kursor turgan koddan bitta harfni tashlab oldingi harfni kursor oldiga olib o'tadi

ctrl+shift+a			Popup ochiladi va popupga so'zni yozsa o'sha belgilandan kodni o'sha popupga yozilgan divni ichiga kirgazadi


# Тепадагиларнинг бирортасига кирмайдиган бошка турдагилар

ctrl+,				sozlash menyusini ochadi

ctrl+alt+h			shortkodelarni hammsini ko'rsatadi

alt+e || alt+shift+e		kodladi xatolarni ko'rsatadi

F1				qandaydur menyu ochiladi menimcha ko'p funksiyalarni qilsa bo'ladigan menyu

ctrl+alt+a			kodni hammasini tekish qiladi (hali to'liq tushunmadim)


# Yoqqan bo'lsa yulduzcha bosish esdan chiqamasin

# Fayl mejr rasmlari
![alt text](https://raw.githubusercontent.com/akbarali1/file-menjr/main/photos/newfolder.png)
![alt text](https://raw.githubusercontent.com/akbarali1/file-menjr/main/photos/newfile.png)
![alt text](https://raw.githubusercontent.com/akbarali1/file-menjr/main/photos/login.png)
![alt text](https://raw.githubusercontent.com/akbarali1/file-menjr/main/photos/index.png)
![alt text](https://raw.githubusercontent.com/akbarali1/file-menjr/main/photos/ifsnippet.png)
![alt text](https://raw.githubusercontent.com/akbarali1/file-menjr/main/photos/fileeditor.png)
![alt text](https://raw.githubusercontent.com/akbarali1/file-menjr/main/photos/dellete.png)
![alt text](https://raw.githubusercontent.com/akbarali1/file-menjr/main/photos/rename.png)