#000webhost for some reason deliberately
#stops us from extracting nested folders in zipfiles
#so we do it a bit manually
from tarfile import TarFile
import os
path = os.path
#Helps you find the files, for some reason, baby just stands out
suffix = "-baby.tar"
extensions = ["css","js","php","html","jpg","jpeg","png"]
allowed = [".htaccess"]
count = 1
BASE_TIME = 0
def is_newer(name):
    return path.getmtime(name)>BASE_TIME
def make_tar(folder,dest=None):
    global count
    folders = []
    files = []
    if dest is None:
        dest = folder+suffix
    tar = TarFile(dest,"w")
    cwd = path.realpath(os.curdir);
    os.chdir(folder);
    all = os.listdir(".")
    has = False
    for name in all:
        if name[0]==".":
            if name in allowed and is_newer(name):
                has = True
                tar.add(name)
        elif path.isdir(name):
            try:
                if make_tar(folder+"/"+name):
                    has = True
                    tar.add(name+suffix)
            finally:
                if path.exists(folder+"/"+name+suffix):
                    os.remove(folder+"/"+name+suffix)
        else:
            for ext in extensions:
                if name.endswith("."+ext):
                    if is_newer(name):
                        has = True
                        tar.add(name)
                    break
    tar.close()
    os.chdir(cwd)
    if has:
        print(("{}: "+folder).format(count));
        count+=1
    return has
if __name__=="__main__":
    import sys
    if path.exists("root.tar") and "-u" in sys.argv:
        BASE_TIME = path.getmtime("root.tar")
    make_tar(path.realpath(sys.argv[1]),"root.tar");
    # os.system('find -path "*'+suffix+'" -delete')