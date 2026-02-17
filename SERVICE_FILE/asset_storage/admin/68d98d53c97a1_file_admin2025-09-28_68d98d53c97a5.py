#berupa interger
#koordinat ini merupakan sesuai dengan index pada array, belum di reverse
posisi_robot = [] #[ index_baris, index_kolom]
posisi_barang = {} #{ "barang_1" : [index_baris,index_kolom], "barang_2" : [index_baris,index_kolom ] }
posisi_lantai_rusak = [] #[x, y]
map = []
#Informasi untuk koordinat baris dan kolom yang ada pada map, setelah map di buat
koordinat_baris = []
koordinat_kolom = []
ambil_barang = "" #Key dari barang yang dipilih untuk diambil


msg_moving = "Tidak bisa bergerak ke situh"
msg_put = "Tidak bisa menaruh ke situh"
msg_pick = "Tidak bisa mengambil barang ke situh"

def buat_map():
    global map
    map = [
        ["0", "0", "0", "0", "0", "0", "0"],
        ["0", "0", "X", "0", "0", "0", "0"],
        ["0", "0", "0", "0", "0", "1", "0"],
        ["1", "0", "0", "0", "0", "0", "0"],
        ["0", "0", "0", "0", "0", "-1", "0"]
    ]

def simpan_posisi():
    #Simpan informasi koordinat untuk posisi robot, barang, dan lantai rusak pada map
    for index_baris in range( len( map ) ):
        array_baris = map[ index_baris ]
        for index_kolom in range( len( array_baris ) ):
            objek = array_baris[ index_kolom ]
            if objek == "X":
                simpan_posisi_robot( index_baris, index_kolom )
                # print( "Robot Ditemukan pada array baris ke -", index_baris )
            elif objek == "1":
                simpan_posisi_barang( index_baris, index_kolom )
                # print( "Barang Ditemukan pada array baris ke -", index_baris )
            elif objek == "-1":
                simpan_posisi_lantai_rusak( index_baris, index_kolom )
                # print( "Lantai Rusak Ditemukan pada array baris ke -", index_baris )             



def simpan_posisi_robot( index_baris, index_kolom ):
    # Karena robot hanya ada 1 koordinat, maka ketika misalnya koordinat sudah diisi jika menyimpan kembali yang dilakukan adalah mengupdate, bukan menambah nilai pada arraynya
    global posisi_robot

    if len( posisi_robot ) < 1 :
        # Jika sudah ada koordinat, maka tambah koordinat baru
        # print( "Koordinat Belum ada, tambah koordinat" )
        posisi_robot.append( index_baris ) #x
        posisi_robot.append( index_kolom ) #y
    else:
        # Jika sudah ada koordinat atau robot melakukan perpindahan/pergerakan, maka lakukan update

        '''
        Ubah simbol pada koordinat posisi robot yang lama pada map dengan ketentuan :
        - Jika koordinat yang ditinggalkan ( Koordinat lama ) oleh robot itu tadinya adalah koordinat untuk lantai rusak, maka ubah simbolnya dengan -1 yaitu lantai rusak
        - Jika koordinat yang ditinggalkan ( Koordinat lama ) oleh robot itu tadinya adalah koordinat bukan lantai rusak, maka ubah simbolnya dengan 0 yaitu lantai kosong
        '''
        index_baris_lama = posisi_robot[0]
        index_kolom_lama = posisi_robot[1]
        index_baris_lantai_rusak = posisi_lantai_rusak[0]
        index_kolom_lantai_rusak = posisi_lantai_rusak[1]
        if index_baris_lama == index_baris_lantai_rusak and index_kolom_lama == index_kolom_lantai_rusak:
            #Jika yang ditinggalkan tadinya lantai rusak
            simbol = "-1"
        else:
            #Jika yang ditinggalkan tadinya bukan lantai rusak
            simbol = "0"
        map[ index_baris_lama ][ index_kolom_lama  ] = simbol

        #Simpan posisi robot dengan koordinat yang dituju atau yang baru
        posisi_robot[0] = index_baris
        posisi_robot[1] = index_kolom

        #Ubah simbol pada koordinat posisi robot yang baru pada map dengan simbol X yaitu robot
        index_baris_baru = posisi_robot[0]
        index_kolom_baru = posisi_robot[1]
        map[ index_baris_baru ][ index_kolom_baru ] = "X"
        # print( "Koordinat sudah ada" )



def simpan_posisi_barang( index_baris, index_kolom ):
    #ada 2 koordinat dan setiap koordinatnya harus mempunyai pemilik pengenal barangnya agar bisa tahu suatu koordinat ity dimiliki oleh barang yang mana
    #maka akan memakai konsep dictionary multidimensi dengan identifiernya sebagai keynya dab vakuenya merupakan array index yang berisi koordinat cth : { identifier : [ index_baris, index_kolom ] }
    #dictionary tersebut akan memiliki key atau anggota nilai maksimal 2 saja, yang artinya bisa nambah key atau nilai array hanya 2 kali tapi jika sudah mencapai batas maksimalnya maka hanya akan melakukan update ke key yang dipilih berdasarkamn identifiernya    
    global posisi_barang
    if len( posisi_barang ) < 2 :
        # Jika belum ada koordinat untuk robot, maka tambah koordinat dengan identifier baru
        # identifiernya berupa string dengan rumus barang_n, dengan n adalah urutan increment 1 setiap barang baru ditambahkan cth : { "barang_1" : [index_baris, index_kolom], "barang_2" : [index_baris, index_kolom,  }
        identifier_baru = "barang_" + str( len( posisi_barang ) + 1 )
        barang_baru = { identifier_baru : [ index_baris, index_kolom ] }
        posisi_barang.update( barang_baru )
    else:
        # Jika sudah ada mencapai batas maksimal atau sudah ada 2 koordinat barang, maka lakukan update sesuai dengan identifiernya
        barang_update = posisi_barang[ ambil_barang ]
        # Ubah simbol pada koordinat posisi barang yang dipilih yang lama pada map dengan simbol 0 yaitu lantai kosong :
        index_baris_lama = barang_update[0]
        index_kolom_lama = barang_update[1]
        map[ index_baris_lama ][ index_kolom_lama ] = "0"

        #Simpan posisi barang yang dipilih dengan koordinat yang dituju atau yang baru
        # key atau identifier yang akan di update analisa dari koordinat yang baru ( yang dikirimkan di paramaeter ) terhadap dictionarynya
        # key atau identifier barang yang akan di ubah koordinatnya diambil dari variabel ambil_barang yang sebelumnya diisi ketika uesr mengambil barang
        # print( "Koordinat barang yang bisa simpan sudah mencapai batas maksimal, update koordinat barang yang diambil" )
        barang_update[0] = index_baris
        barang_update[1] = index_kolom

        #Ubah simbol pada koordinat posisi barang yang dipilin yang baru pada map dengan simbol 1 yaitu barang
        index_baris_baru = barang_update[ 0 ]
        index_kolom_baru = barang_update[ 1 ]
        map[ index_baris_baru ][ index_kolom_baru ] = "1"


def simpan_posisi_lantai_rusak( index_baris, index_kolom ):
    # Karena lantai rusak hanya ada 1 koordinat, maka ketika misalnya koordinat sudah diisi jika menyimpan kembali yang dilakukan adalah mengupdate, bukan menambah nilai pada arraynya
    global posisi_lantai_rusak
    if len( posisi_lantai_rusak ) < 1 :
        # Jika belum ada koordinat untuk robot, maka tambah koordinat baru
        # print( "Koordinat Belum ada, tambah koordinat" )
        posisi_lantai_rusak.append( index_baris ) #x
        posisi_lantai_rusak.append( index_kolom ) #y
    else:
        # Jika sudah ada koordinat, maka lakukan update
        # print( "Koordinat sudah ada" )
        posisi_lantai_rusak[0] = index_baris
        posisi_lantai_rusak[1] = index_kolom


def simpan_koordinat_map():
    # Mengisi koordinat baris dan kolom yang ada di map 
    # Yang akan digunakan untuk mengecek ketersediaan index baris atau index kolom pada map

    # Simpan koordinat index baris
    for index_baris in range( len( map ) ):
        koordinat_baris.append( index_baris )

    # Simpan koordinat index kolom per baris
    #INGAT!! Setiap baris punya jumlah kolom yang sama dan nomor index kolomnya pasti sama semua di setiap baris
    #dan 1 baris, bisa mewakili nomor index kolom yang ada di baris lainnya
    sample_baris = map[0]
    for index_kolom in range( len( sample_baris ) ):
        koordinat_kolom.append( index_kolom )


def init_map():
    buat_map()
    simpan_posisi()
    simpan_koordinat_map()



'''
+++++++++ FUNGSI TERKAIT VALIDASI SUATU KOORDINAT LANTAI/KOLOM ++++++++++++++
'''
def cek_lantai_rusak( index_baris, index_kolom ):
    '''
    - Fungsi ini akan mengecek apakah di kolom/lantai di koordinat yang di parameter ada objek seperti barang atau lainnya
    - Jika fungsi ini mengembalikan nilai True, maka lantai/kolom yang di cek merupakan lantai rusak
    - Jika fungsi ini mengembalikan nilai False, maka lantai/kolom yang di cek bukan lantai rusak
    - Ingat !! lantai rusak boleh ditempati oleh robot tapi tidak boleh ditempati oleh barang
    - Jadi, jika pada koordinat di kolom/lantai ada suatu objek lain atau barang dengan simbol string -1, maka itu adalah lantai rusak
    '''
    object_kolom = map[ index_baris ][ index_kolom ]
    koordinat = str( index_baris ) +","+ str( index_kolom )
    response = {}
    if object_kolom == "-1":
        response['status'] = True
        response['msg'] = "Lantai/kolom koordinat (" + koordinat + ") merupakan lantai rusak"
    else:
        response['status'] = False
        response['msg'] = "Lantai/kolom koordinat (" + koordinat + ") bukan lantai rusak"

    # print( response )
    return response

def cek_objek_lantai( index_baris, index_kolom ):
    '''
    - Fungsi ini akan mengecek apakah di kolom/lantai di koordinat yang di parameter ada objek seperti barang atau lainnya
    - Jika fungsi ini mengembalikan nilai True, maka lantai/kolom yang di cek terdapat objek
    - Jika fungsi ini mengembalikan nilai False, maka lantai/kolom yang di cek tidak terdapat objek
    - Ingat !! 1 lantai/kolom hanya bisa ditempati oleh 1 objek yaitu barang atau robot
    - Jadi, jika pada koordinat di kolom/lantai ada suatu objek lain atau barang dengan simbol string 1, maka koordinat kolom tersebut tidak bisa di tempati
    '''
    objek_kolom = map[index_baris][index_kolom]
    koordinat = str( index_baris ) + "," + str( index_kolom )
    response = {}
    if objek_kolom == "1":
        # Jika ada objek barang pada lantai/kolom yang dituju oleh robot
        response['status'] = True
        response['msg'] = "ADA object barang yang menempati lantai pada koordinat("+ koordinat +")"
    else:
        # Jika tidak ada objek barang pada lantai/kolom yang dituju oleh robot
        response['status'] = False
        response['msg'] = "TIDAK ADA object barang yang menempati lantai pada koordinat("+ koordinat +")"


    return response

def cek_koordinat( index_baris, index_kolom ):
    '''
    - Akan mengecek koordinat baru yang akan dituju oleh robot ketika dipindahkan
     Ketentuan nilai yang dikembalikan fungsi : 
       - Jika fungsi ini mengembalikan nilai True, maka validasi lolos atau koordinat ( index baris atau index kolom ) yang akan di tempati robot ada
       - Jika fungsi ini mengembalikan nilai False, maka validasi gagal atau koordinat ( index baris atau index kolom ) yang akan di tempati robot tidak ada
    '''
    response = {}
    koordinat = str( index_baris ) + "," + str( index_kolom )
    if index_baris in koordinat_baris and index_kolom in koordinat_kolom:
        # Jika Koordinat index baris atau koordinat index kolom ADA di map 
        response['status'] = True
        response['msg'] = "Koordinat index baris atau koordinat index kolom yang dituju ( "+koordinat+" ) ADA di map"
    else:
        # Jika Koordinat index baris atau koordinat index kolom TIDAK ADA di map 
        response['status'] = False
        response['msg'] = "Koordinat index baris atau koordinat index kolom yang dituju ( "+koordinat+" ) TIDAK ADA di map"

    return response


'''
+++++++++ FUNGSI TERKAIT PERGERAKAN ROBOT ++++++++++++++
- Fungsi up(), down(), right(), dan left() untuk memindahkan Robot hanya akan berpindah 1 kolom saja
- Jadi koordinaat yang dituju itu akan mengurangi 1 index koordinat dari index koordinat yang ditempati sekarang dan yang dikuranginya itu untuk index baris atau index kolom itu tergantung arah pindah robotnya
- Referensi variabel : map dan posisi_robot
- fungsi up() dan down() yang berubah index barisnya
- fungsi left() dan right() yang berubah index kolomnya
- Jika berpindah ke index koordinat selanjutnya maka indexnya di tambah 1, untuk fungsi down() dan right()
- Jika berpindah ke index koordinat sebelumnya maka indexnya di kurang 1, untuk fungsi up() dan left()
- posisi_robot[ 0 ] => untuk index baris
- posisi_robot[ 1 ] => untuk index kolom
- Note : Lantai rusak bisa ditempati oleh robot yang artinya tidak usah melakukan validasi terhadap koordinat lantai rusak
posisi_robot 
'''
def validasi_pergerakan( index_baris, index_kolom ):
    '''
     - Referensi variabel posisi_robot dan map
     - Jika fungsi ini mengembalikan nilai True, maka artinya koordinat lantai/kolom yang di validasi bisa ditempati, atau koordinatnya ada di map dan pada lantai/kolom tersebut TIDAK TERDAPAT OBJEK LAIN 
     - Jika fungsi ini mengembalikan nilai False, maka artinya koordinat lantai/kolom yang di validasi tidak bisa ditempati, atau koordinatnya tidak ada di map dan pada lantai/kolom tersebut TERDAPAT OBJEK LAIN 
     - Jika salah satu kondisi dibawah ini terpenuhi maka mengembalikan nilai False tapi jika tidak terpenuhi maka mengembalikan nilai True yang artinya objek bisa dipindahkan ke lantai atau kolom tersebut
     - Aturan Validasi :
        - koordinat baru atau yang akan dituju oleh robot harus ada indexnya pada array map
        - robot dapat menempati koordinat lantai/kolom yang rusak
        - kolom pada suatu koordinat tidak boleh ditempati jika kolom/lantai sudah ditempati oleh objek lainnya seperti barang ( 1 ), atau robot itu sendiri   
    '''

    response = {}
    cek_koordinat_baru = cek_koordinat( index_baris, index_kolom )
    #Cek koordinat yang dituju robot
    if cek_koordinat_baru['status'] == True:
        #Maka koordinat baru yang akan dituju ada di map
        #Cek koordinat yang dituju robot apakah di kolomnya ada objet atau tidak
        cek_objek_lantai_target = cek_objek_lantai( index_baris, index_kolom )
        if cek_objek_lantai_target['status'] == False:
            # Maka tidak ada objek pada lantai/kolom yang dituju oleh robot
            response['status'] = True
        else:
            # Maka ada objek pada lantai/kolom yang dituju oleh robot
            response['status'] = False
            response['msg'] = cek_objek_lantai_target['msg']
    else:
        response = cek_koordinat_baru

    # print( response )
    return response

def up():
    '''
    - Robot Pindah ke atas, berarti pindah ke BARIS SEBELUMNYA, dan yang diubah atau DIKURANGI itu hanya index barisnya
    - Diubah dengan Index barisnya DIKURANGI 1 karena berpindah 1 baris ke index baris array sebelumnya
    '''
    index_baris = posisi_robot[0] 
    index_kolom = posisi_robot[1]
    
    index_baris_baru = index_baris - 1
    # Validasi koordinat baru atau koordinat yang akan di tuju robot
    validasi_pergerakan_robot = validasi_pergerakan( index_baris_baru, index_kolom )
    if validasi_pergerakan_robot['status'] == True:
        # print("Koordinat baru ada di map yang bisa dituju robot dan bisa disimpan update posisi robotnya")
        simpan_posisi_robot( index_baris_baru, index_kolom )
    else:
        print( msg_moving, validasi_pergerakan_robot['msg'] )
        # print("Where are you going?")

# YANG BERUBAH INDEX BARISNYA
def down():
    '''
    - Robot Pindah ke bawah, berarti pindah ke BARIS SELANJUTNYA, dan yang diubah atau DITAMBAH itu hanya index barisnya
    - Diubah dengan Index barisnya DITAMBAH 1 karena berpindah 1 baris ke index baris array sebelumnya
    '''
    index_baris = posisi_robot[0] 
    index_kolom = posisi_robot[1]
    
    index_baris_baru = index_baris + 1
    # Validasi koordinat baru atau koordinat yang akan di tuju robot
    validasi_pergerakan_robot = validasi_pergerakan( index_baris_baru, index_kolom )
    if validasi_pergerakan_robot['status'] == True:
        # print("Koordinat baru ada di map yang bisa dituju robot dan bisa disimpan update posisi robotnya")
        simpan_posisi_robot( index_baris_baru, index_kolom )
    else:
        print( msg_moving, validasi_pergerakan_robot['msg'] )
        # print("Where are you going?")

# YANG BERUBAH INDEX KOLOMNYA
def left():
    '''
    - Robot Pindah ke ke kanan, berarti pindah ke BARIS SEBELUMNYA, dan yang diubah atau DIKURANGI itu hanya index barisnya
    - Diubah dengan Index barisnya DIKURANGI 1 karena berpindah 1 baris ke index baris array sebelumnya
    '''
    index_baris = posisi_robot[0] 
    index_kolom = posisi_robot[1]
    
    index_kolom_baru = index_kolom - 1
    # Validasi koordinat baru atau koordinat yang akan di tuju robot
    validasi_pergerakan_robot = validasi_pergerakan( index_baris, index_kolom_baru )
    if validasi_pergerakan_robot['status'] == True:
        # print("Koordinat baru ada di map yang bisa dituju robot dan bisa disimpan update posisi robotnya")
        simpan_posisi_robot( index_baris, index_kolom_baru )
    else:
        print( msg_moving, validasi_pergerakan_robot['msg'] )
        # print("Where are you going?")
def right():
    '''
    - Robot Pindah ke ke kanan, berarti pindah ke BARIS SELANJUTNYA, dan yang diubah atau DITAMBAH itu hanya index barisnya
    - Diubah dengan Index barisnya DITAMBAH 1 karena berpindah 1 baris ke index baris array selanjutnya
    '''
    index_baris = posisi_robot[0] 
    index_kolom = posisi_robot[1]
    
    index_kolom_baru = index_kolom + 1
    # Validasi koordinat baru atau koordinat yang akan di tuju robot
    validasi_pergerakan_robot = validasi_pergerakan( index_baris, index_kolom_baru )
    if validasi_pergerakan_robot['status'] == True:
        # print("Koordinat baru ada di map yang bisa dituju robot dan bisa disimpan update posisi robotnya")
        simpan_posisi_robot( index_baris, index_kolom_baru )
    else:
        print( validasi_pergerakan_robot['msg'] )
        # print("Where are you going?")

def scan():
   input_user_direction = input("Masukkan arah lokasi yang ingin di scan : ")    
   index_baris = posisi_robot[0]
   index_kolom = posisi_robot[1]   
   if input_user_direction == "u":
       arah = "Up"
       index_baris = index_baris - 1 
   elif input_user_direction == "d":
       arah = "Down"
       index_baris = index_baris + 1
   elif input_user_direction == "l":
       arah = "Left"
       index_kolom = index_kolom - 1
   elif input_user_direction == "r":
       arah = "Right"
       index_kolom = index_kolom + 1
       
   #Cek apakah koordinat tersebut ada atau tidak di map    
   cek_koordinat_baru = cek_koordinat( index_baris, index_kolom )
   if cek_koordinat_baru['status'] == True:
       #Cek apakah ada objek selain robot yaitu barang yang ada pada lantai/kolom koordinat tersebut
       cek_objek_lantai_target = cek_objek_lantai( index_baris, index_kolom )
    #    if cek_objek_lantai_target['status'] == True:
    #        #Jika ada barang pada objek
    #        result = "Found Some Object On My"
    #    else:
    #        result = "Found Nothing On My"

       print( "Ditemukan", cek_objek_lantai_target['msg'], arah )
   else:
       #Jika koordinat tidak ada di map
       print( "Ditemukan", cek_koordinat_baru['msg'] )

def show_map():
    for baris_map in map:
        print( baris_map )








def update_ambil_barang( index_baris, index_kolom ):
    #referensi variabel ambil_barang
    global ambil_barang
    #Cari key barang dengan koordinat yang diambil dan simpan di variabel untuk nantinya di taro
    for key_barang in posisi_barang:
        cek_posisi_barang = posisi_barang[ key_barang ]
        index_baris_barang = cek_posisi_barang[0]
        index_kolom_barang = cek_posisi_barang[1]

        if index_baris == index_baris_barang:
            if index_kolom == index_kolom_barang:
                ambil_barang = key_barang   

def pickup():
    # INGAT !! Hanya bisa ngepick satu barang saja, jika barangnya yang dipick lebih dari satu maka fungsi pick terhenti
    if len( ambil_barang ) > 0:
        print("Hanya bisa membawa 1 barang")
        return False

    input_user_direction = input("Masukkan arah lokasi barang yang ingin diambil : ")     
    index_baris = posisi_robot[0]
    index_kolom = posisi_robot[1]   
    if input_user_direction == "u":
        arah = "Up"
        index_baris = index_baris - 1 
    elif input_user_direction == "d":
       arah = "Down"
       index_baris = index_baris + 1
    elif input_user_direction == "l":
        arah = "Left"
        index_kolom = index_kolom - 1
    elif input_user_direction == "r":
        arah = "Right"
        index_kolom = index_kolom + 1

   #Cek apakah koordinat tersebut ada atau tidak di map    
    cek_koordinat_baru = cek_koordinat( index_baris, index_kolom )
    if cek_koordinat_baru['status'] == True:
        #Cek apakah ada objek selain robot yaitu barang yang ada pada lantai/kolom koordinat tersebut
        cek_objek_lantai_target = cek_objek_lantai( index_baris, index_kolom )
        if cek_objek_lantai_target['status'] == True:
            #Jika ada barang yang diambil pada lantai/kolom yang dicek atau tuju
            update_ambil_barang( index_baris, index_kolom )
            map[ index_baris ][ index_kolom ] = "0"
            print("Object berhasil diambil")
        else:
            #Jika tidak ada barang yang diambil pada lantai/kolom yang dicek atau tuju
            print( msg_pick, cek_objek_lantai_target['msg'] )
    else:
        print( msg_pick, cek_koordinat_baru['msg'] )


def put():
    global ambil_barang
    # INGAT !! Hanya bisa menaruh barang ketika :
    '''
    - Variabel ambil_barang ( berisi key barang yang diambil ) sudah terisi, yang artinya ada barang yang di ambil
    - Koordinat Lantai/kolom yang dituju ada di map
    - Koordinat Lantai/kolom yang dituju tidak ada object lain
    - Koordinat Lantai/kolom yang dituju bukan lantai rusak
    '''
    if len( ambil_barang ) < 1:
        print("Tidak ada barang yang diambil untuk di taruh")
        return False

    #Taruh barang ke arah yang di inginkan user dari posisi koordinat robot yang disimpan
    input_user_direction = input("Taruh barang dimana : ")  
    index_baris = posisi_robot[0]
    index_kolom = posisi_robot[1]   
    if input_user_direction == "u":
        arah = "Up"
        index_baris = index_baris - 1 
    elif input_user_direction == "d":
       arah = "Down"
       index_baris = index_baris + 1
    elif input_user_direction == "l":
        arah = "Left"
        index_kolom = index_kolom - 1
    elif input_user_direction == "r":
        arah = "Right"
        index_kolom = index_kolom + 1
    else:
        print("Perintah tidak dikenali")
        return False

    
   #Cek apakah koordinat tersebut ada atau tidak di map    
    cek_koordinat_baru = cek_koordinat( index_baris, index_kolom )
    if cek_koordinat_baru['status'] == True:
        #Cek apakah ada object barang di koordinat yang akan ditempati
        cek_objek_lantai_target = cek_objek_lantai( index_baris, index_kolom )
        if cek_objek_lantai_target['status'] == False:
            #Cek apakah lantai/kolom koordinat itu lantai rusak atau bukan
            cek_lantai_rusak_target = cek_lantai_rusak( index_baris, index_kolom )

            if cek_lantai_rusak_target['status'] == False:
                #Posisi koordinat barang yang akan di simpan relatif dari posisi robot 
                simpan_posisi_barang( index_baris, index_kolom )
                print( "Berhasil menaruh barang dan update", ambil_barang, "dengan koordinat baru" )
                #Hapus isi ambil_barang agar tidak ada barang yang diambil 
                ambil_barang = ""
            else:
                print( msg_put, cek_lantai_rusak_target['msg'] )
        else:            
            print( msg_put, cek_objek_lantai_target['msg'] )
    else:
        print( cek_koordinat_baru['msg'] )

# init_map()
# show_map()
# print( posisi_barang )
# pickup()
# show_map()
# put()
# print( posisi_barang )
# show_map()


def exit_program():
    print( "Program Terhenti" )

def main():

    # Lakukan Inisialisasi atau buat mapnya, jika programnya baru dijalankan atau variabel map masih kosong
    if len( map ) < 1:
        init_map()
    
    print("="*20)
    input_user = input("Masukkan perintah mu : ")
    print("="*20)


    #cek input yang di inginkan oleh user
    if input_user != "q":
        if input_user == "u":
            up()
        elif input_user == "d":
            down()
        elif input_user == "l":
            left()
        elif input_user == "r":
            right()
        elif input_user == "w":
            show_map()
        elif input_user == "s":
            scan()
        elif input_user == "pi":
            pickup()
        elif input_user == "pu":
            put()
        else:
            print( "Perintah tidak dikenali" )
        
        # Lakukan rekusif disini
        main()
    else:
        # Jika perintah yang dimasukkan untuk keluar program, maka tidak akan ada rekursif
        # Kalo keluar program, maka tidak ada rekursif lagi
        exit_program()        


menu_main = {
        "w" : "untuk menampilkan map",
        "q" : "untuk keluar",
        "r" : "untuk robot bergerak ke kanan",
        "l" : "untuk robot bergerak ke kiri",
        "u" : "untuk robot bergerak ke atas",
        "d" : "untuk robot bergerak ke bawah",
        "pi" : "untuk robot mengambil barang",
        "pu" : "untuk robot menaruh barang",
    }
for key in menu_main:
    print(key, menu_main[key])
main()
